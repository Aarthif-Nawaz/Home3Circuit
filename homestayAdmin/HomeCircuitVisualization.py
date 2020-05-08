import pickle
from csv import writer
import mysql.connector
import matplotlib.pyplot as plt
import numpy as np
import pandas as pd
from sklearn import metrics
from sklearn.linear_model import LinearRegression
from sklearn.model_selection import train_test_split
import sys
import os

df = pd.read_csv('HomeCircuit - Sheet1.csv', usecols=['Colombo', 'price per night', 'culture', 'medical', 'weather'])
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="",
  database="homestay"
)



def append_list_as_row(file_name, list_of_elem):
  with open(file_name, 'a+', newline='') as write_obj:
    csv_writer = writer(write_obj)
    csv_writer.writerow(list_of_elem)


scaler = LinearRegression()
val = sys.argv[1]
colomboArea = df[df['Colombo'] == int(val)]


X = colomboArea[['Colombo']]
y = colomboArea[['culture', 'medical', 'weather']]
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.11, random_state=42)
scaler.fit(X_train, y_train)
prediction = scaler.predict(X_test)
# print(metrics.mean_absolute_error(y_test, prediction))
# print(metrics.mean_squared_error(y_test, prediction))
# print(np.sqrt(metrics.mean_squared_error(y_test, prediction)))
# plt.scatter(y_test, prediction)
# plt.show()

# save the model to disk
filename = 'finalized_model.sav'
pickle.dump(scaler, open(filename, 'wb'))

# some time later...
# load the model from disk
loaded_model = pickle.load(open(filename, 'rb'))
value = loaded_model.predict(X_test)
result = loaded_model.score(X_test, y_test)
# print(value)
# print(result)

factors = ['culture', 'medical', 'weather']
dataset = df.groupby('Colombo')[factors].mean()
# print(dataset)

index = np.arange(1)
labels_percentage = np.arange(0, 110, 10)
lists = []
cultureSets = dataset['culture']
medicalSets = dataset['medical']
weatherSets = dataset['weather']

mycursor = mydb.cursor()
delsql = "DELETE FROM factor WHERE factorID IN ('1','2','3')"

mycursor.execute(delsql)

mydb.commit()

sql = 'INSERT INTO factor(factorID, factor, PercentageImpacted) VALUES (%s, %s, %s)'
val = [(1, "Culture",float(prediction[0][0])),
       (2, "Medical",float(prediction[0][1])),
       (3, "Weather",float(prediction[0][2]))]
mycursor.executemany(sql,val)
mydb.commit()




colombo1 = list(dataset.T[1])
colombo2 = list(dataset.T[2])
colombo3 = list(dataset.T[3])
colombo4 = list(dataset.T[4])
colombo5 = list(dataset.T[5])
colombo6 = list(dataset.T[6])
colombo7 = list(dataset.T[7])

bar_width = 0.25
fig, ax = plt.subplots()
culturebar = ax.bar(index + 0.00, cultureSets[2], bar_width, label='Culture')
medicalbar = ax.bar(index + 0.35, medicalSets[2], bar_width, label='Medical')
weatherbar = ax.bar(index + 0.70, weatherSets[2], bar_width, label='Weather')

ax.set_xticklabels("")

ax.set_yticks(labels_percentage)
ax.set_yticklabels(labels_percentage)

ax.legend()
ax.spines['top'].set_visible(False)
ax.spines['right'].set_visible(False)
ax.spines['left'].set_visible(False)
ax.spines['bottom'].set_color('#DDDDDD')
ax.tick_params(bottom=False, left=False)
ax.set_axisbelow(True)
ax.yaxis.grid(True, color='#EEEEEE')
ax.xaxis.grid(False)

# Add axis and chart labels.
ax.set_xlabel('Colombo 1', labelpad=15)
ax.set_ylabel('Percentage ', labelpad=15)
ax.set_title('The Liked Percentage For Different Factors In Colombo 1', pad=15)

fig.tight_layout()
#plt.show()
# plt.show(sns.boxplot(x='culture',y='medical',data=df))
