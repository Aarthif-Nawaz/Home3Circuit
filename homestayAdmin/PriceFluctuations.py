import sys

import mysql.connector
import requests, json
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns
api_key = "7fc8cfeac18cbcb818a2a2372787aa20"
base_url = "http://api.openweathermap.org/data/2.5/weather?"
city_name = "Colombo"
complete_url = base_url + "appid=" + api_key + "&q=" + city_name
response = requests.get(complete_url)
x = response.json()
z = x["weather"]
weather_description = z[0]["description"]

df = pd.read_csv("HomeCircuit - Sheet1.csv", parse_dates=[1] ,header=0)
name = sys.argv[1]
homestay = df.loc[df['HomeStay'] == str(name)]

import datetime
today = datetime.datetime.today()
datem = datetime.datetime(today.year, today.month,1)
print(today.month)
currentPrice = homestay['price per night']
newPrice = 0
if("clear sky" in weather_description):
	newPrice = (currentPrice.iloc[0]*1)/100
	newPrice = currentPrice + newPrice
elif("few clouds" in weather_description):
	newPrice = (currentPrice.iloc[0]*2)/100
	newPrice = currentPrice - newPrice
elif("scattered clouds" in weather_description):
	newPrice = (currentPrice.iloc[0]*1)/100
	newPrice = currentPrice + newPrice
elif("broken clouds" in weather_description):
	newPrice = (currentPrice.iloc[0]*15)/100
	newPrice = currentPrice - newPrice
elif("shower rain" in weather_description):
	newPrice = (currentPrice.iloc[0]*10)/100
	newPrice = currentPrice - newPrice
elif("rain" in weather_description):
	newPrice = (currentPrice.iloc[0]*5)/100
	newPrice = currentPrice - newPrice
elif("thunderstorm" in weather_description):
	newPrice = (currentPrice.iloc[0]*20)/100
	newPrice = currentPrice - newPrice
elif("mist" in weather_description):
	newPrice = (currentPrice.iloc[0]*20)/100
	newPrice = currentPrice + newPrice
else:
	newPrice = currentPrice


mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="homestay"
)
mycursor = mydb.cursor()
delsql = "truncate table fluctuation"

mycursor.execute(delsql)

mydb.commit()
year = 2020
if(today.month==1):
	year = year +1
else:
	year = today.year
newDay = str(today.day+7)
sql = 'INSERT INTO fluctuation(month, currentPrice, newDay, newPrice) VALUES (%s, %s,%s, %s)'
val = (str(today.day)+"-"+str(today.month)+"-"+str(year), float(currentPrice.iloc[0]),str(newDay)+"-"+str(today.month)+"-"+str(year),float(newPrice.iloc[0]))
mycursor.execute(sql,val)
mydb.commit()
