from flask import Flask, jsonify, request
import pandas as pd
from sklearn.ensemble import RandomForestRegressor
from sklearn.metrics import r2_score
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
from textblob import TextBlob

app = Flask(__name__)

@app.route('/predict', methods=['POST'])
def predict():
    # Load the dataset
    df = pd.read_csv(request.files['data'])

    # Extract the month from the ordertime column
    df["month"] = pd.to_datetime(df["ordertime"]).dt.month

    # Group the data by month and product id and sum the quantity
    grouped_data = df.groupby(["month", "productid"])["qty"].sum().reset_index()

    # Sort the data by month and quantity in descending order
    sorted_data = grouped_data.sort_values(["month", "qty"], ascending=[True, False])

    # Loop through each month
    predictions = []
    for month in range(1, 13):
        # Create a new dataset with the product ids and their corresponding quantities for the current month
        month_data = sorted_data[sorted_data["month"] == month][["productid", "qty"]]

        # Skip processing for the current month if there are no orders for any of the products
        if len(month_data) == 0:
            predictions.append({"month": month, "best_selling_product": "No orders for any products in this month"})
            continue

        # Merge the productid and price columns from the original dataset
        month_data = pd.merge(month_data, df[["productid", "price"]], on="productid")

        X = month_data.drop(["productid", "qty"], axis=1)
        y = month_data["qty"]

        # Split the data into training and testing datasets
        X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.3, random_state=42)

        # Train a Random Forest Regression model with 100 trees
        rf_regressor = RandomForestRegressor(n_estimators=100)
        rf_regressor.fit(X_train, y_train)

        # Make predictions on the testing data
        y_pred = rf_regressor.predict(X_test)
        

        # Evaluate the model using R-squared metric
        r2 = r2_score(y_test, y_pred)

        # Predict the total sales for each product in the current month
        product_sales = month_data[["productid", "price"]]
        product_sales["qty_pred"] = rf_regressor.predict(X)
        product_sales["total_sales_pred"] = product_sales["qty_pred"] * product_sales["price"]
        top_product = product_sales.iloc[product_sales["total_sales_pred"].argmax()]

        # Add the predictions to the list
        predictions.append({"month": month, "r2_score": round(r2, 2), "best_selling_product": top_product['productid'] })
    
    return {"predictions": predictions}
@app.route('/predict2', methods=['POST'])
def predict_sales():
    csv_file = request.files['csv_file']
    month = int(request.form['month'])

    # Load data from CSV file
    sales_data = pd.read_csv(csv_file)

    # Filter data by month
    month_data = sales_data[sales_data['month'] == month]

    # Prepare data for linear regression
    X = sales_data[['month']]
    y = sales_data[['sales']]

    # Train linear regression model
    model = LinearRegression()
    model.fit(X, y)
    


    # Make sales prediction
    
    sales = model.predict(pd.DataFrame({'month': [month]}))[0][0]
    total_sales = sales_data['sales'].sum()
    sales_percentage = round((sales / total_sales) * 100)
    sales = round(sales, 2)

    # Return prediction result
    return jsonify({
        'sales_percentage': sales_percentage,
        'sales': sales
    })
@app.route('/Analysis', methods=['POST'])
def sentiment_analysis():
    texts = request.json.get('texts')
    sentiment_scores = []
    for text in texts:
        blob = TextBlob(text)
        sentiment = blob.sentiment.polarity
        sentiment_scores.append(sentiment)
    average_sentiment = sum(sentiment_scores) / len(sentiment_scores)
    response = {
        'positive': len([s for s in sentiment_scores if s > 0]),
        'negative': len([s for s in sentiment_scores if s < 0]),
        'neutral': len([s for s in sentiment_scores if s == 0]),
        'average_sentiment': average_sentiment
    }
    return response

if __name__ == '__main__':
    app.run()