import webbrowser
import mysql.connector

#login voor database
mydb = mysql.connector.connect(
  host="localhost",
  user="yourusername",
  passwd="yourpassword"
)
#locaties van de afvalbakken
start = '/52.114971,5.068714'
bak1 = '/52.084856,5.175886'
bak2 = '/52.084897,5.168815'
bak3 = '/52.081865,5.176547'
route = [start,start]
urlmaps = 'https://www.google.es/maps/dir'

#check voor volle of lege bakken
b1 = 0
b2 = 0
b3 = 0


if b1 == 1 and bak1 not in route:
    route.insert(1, bak1)
elif b1 == 0 and bak1 in route:
    route.remove(bak1)
elif b2 == 1 and bak2 not in route:
    route.insert(1, bak2)
elif b2 == 0 and bak2 in route:
    route.remove(bak2)
elif b3 == 1 and bak3 not in route:
    route.insert(1, bak3)
elif b3 == 0 and bak3 in route:
    route.remove(bak3)


for i in route:
    urlmaps += i
#map wordt geopend in browser
webbrowser.open(urlmaps)


#nodig voor pyton in php
#<?php

#$command = escapeshellcmd('/usr/custom/test.py');
#$output = shell_exec($command);
#echo $output;

#?>