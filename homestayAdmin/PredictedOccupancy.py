import pickle
import sys
import warnings
import random
import itertools
import numpy as np
import matplotlib.pyplot as plt
warnings.filterwarnings("ignore")
plt.style.use('fivethirtyeight')
import pandas as pd
import statsmodels.api as sm
import matplotlib
import mysql.connector
matplotlib.rcParams['axes.labelsize'] = 14
matplotlib.rcParams['xtick.labelsize'] = 12
matplotlib.rcParams['ytick.labelsize'] = 12
matplotlib.rcParams['text.color'] = 'k'

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="homestay"
)

name = sys.argv[1]
df = pd.read_csv("Forecasting.csv", parse_dates=[1] ,header=0)
homestay = df.loc[df['Name'] == str(name)]
# homestay['Date'].min(), homestay['Date'].max()
#
# homestay = homestay.sort_values('Date')
# homestay.isnull().sum()
#
# homestay = homestay.groupby('Date')['Sales'].sum().reset_index()
homestay.index = homestay['Date']
y = homestay['Booking'].resample('MS').mean()
print(y['2020':])
#y.plot(figsize=(15, 6))
from pandas.plotting import autocorrelation_plot
autocorrelation_plot(homestay['Booking'])

from statsmodels.graphics.tsaplots import plot_pacf
plot_pacf(homestay['Booking'], lags=15)


from statsmodels.tsa.arima_model import ARIMA, ARIMAResults

model = ARIMA(df['Booking'], order=(1,0,1))
model_fit = model.fit()
print(model_fit.summary())
residuals = model_fit.resid
residuals.plot()

output = model_fit.forecast()

print(model_fit.forecast(5)[0])
train_size = int(df.shape[0]*0.7)
train, test = df.Booking[0:train_size], df.Booking[train_size:]
print(test.shape)
data = train
predict =[]
for t in test:
    model = ARIMA(data, order=(1,0,1))
    model_fit = model.fit()
    y = model_fit.forecast()
    print(y[0][0])
    predict.append(y[0][0])
    data = np.append(data, t)
    data = pd.Series(data)

from sklearn.metrics import mean_squared_error
mse = mean_squared_error(test.values, predict)
# print(mse)
# print(predict)
model_fit.save('model1.pkl')
loaded = ARIMAResults.load('model1.pkl')
values = loaded.predict()
mycursor = mydb.cursor()
delsql = "truncate table occupancy"

mycursor.execute(delsql)



import datetime
today = datetime.datetime.today()
datem = datetime.datetime(today.year, today.month,1)

from dateutil.rrule import rrule, MONTHLY
from datetime import datetime

def months(start_month, start_year, end_month, end_year):
    start = datetime(start_year, start_month, 1)
    end = datetime(end_year, end_month, 1)
    return [(d.month, d.year) for d in rrule(MONTHLY, dtstart=start, until=end)]
value = sys.argv[2]
year =  today.year
if(today.month + int(value) > 12):
    year = year +1
    predict_month = months(today.month, today.year, ((int(value) + 5)-12), year)
else:
    predict_month = months(today.month,today.year,(int(value)+5),year)

list = []
for j in predict_month:
    list.append(j[0])
print(list)
for i in range (1,len(values)):
    if(i<= int(value)):
        forecast = random.randint(0,3)
        values[i] = values[i] - forecast
        if(today.month + i <= 12):
            year = today.year
            mycursor.execute("INSERT INTO occupancy(month , value) VALUES (%s,%s)", (str(list[i])+"-"+str(year), float(round(values[i]))))
        else:
            year = today.year +1
            mycursor.execute("INSERT INTO occupancy(month , value) VALUES (%s,%s)", (str(list[i]) + "-" + str(year), float(round(values[i]))))
mydb.commit()




# p = d = q = range(0, 2)
# pdq = list(itertools.product(p, d, q))
# seasonal_pdq = [(x[0], x[1], x[2], 12) for x in list(itertools.product(p, d, q))]
# print('Examples of parameter combinations for Seasonal ARIMA...')
# print('SARIMAX: {} x {}'.format(pdq[1], seasonal_pdq[1]))
# print('SARIMAX: {} x {}'.format(pdq[1], seasonal_pdq[2]))
# print('SARIMAX: {} x {}'.format(pdq[2], seasonal_pdq[3]))
# print('SARIMAX: {} x {}'.format(pdq[2], seasonal_pdq[4]))
#
# for param in pdq:
#     for param_seasonal in seasonal_pdq:
#         try:
#             mod = sm.tsa.statespace.SARIMAX(y,order=param,seasonal_order=param_seasonal,enforce_stationarity=False,enforce_invertibility=False)
#             results = mod.fit()
#             #print('ARIMA{}x{}12 - AIC:{}'.format(param, param_seasonal, results.aic))
#         except:
#             continue
# mod = sm.tsa.statespace.SARIMAX(y,order=(1, 1, 1),seasonal_order=(1, 1, 0, 2),enforce_stationarity=False,enforce_invertibility=False)
# results = mod.fit()
# #print(results.summary().tables[1])
# # results.plot_diagnostics(figsize=(16, 8))
# # plt.show()
# pred = results.get_prediction(start=pd.to_datetime('2020-01-01'), dynamic=False)
# pred_ci = pred.conf_int()
# ax = y['2020-01-07':].plot(label='observed')
# pred.predicted_mean.plot(ax=ax, label='One-step ahead Forecast', alpha=.7, figsize=(14, 7))
# ax.fill_between(pred_ci.index,
#                 pred_ci.iloc[:, 0],
#                 pred_ci.iloc[:, 1], color='k', alpha=.2)
# ax.set_xlabel('Date')
# ax.set_ylabel('Sales')
# plt.legend()
# plt.show()
#
# y_forecasted = pred.predicted_mean
# y_truth = y['2020-01-07':]
# mse = ((y_forecasted - y_truth) ** 2).mean()
# print('The Mean Squared Error of our forecasts is {}'.format(round(mse, 2)))
#
# pred_uc = results.get_forecast(steps=100)
# pred_ci = pred_uc.conf_int()
# ax = y.plot(label='observed', figsize=(14, 7))
# pred_uc.predicted_mean.plot(ax=ax, label='Forecast')
# ax.fill_between(pred_ci.index,pred_ci.iloc[:, 0],pred_ci.iloc[:, 1], color='k', alpha=.25)
# ax.set_xlabel('Date')
# ax.set_ylabel('Sales')
# plt.legend()
# plt.show()
