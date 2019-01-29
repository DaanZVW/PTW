#!/usr/bin/env python
# -*- coding: utf-8 -*- 
import mysql.connector


def appendContainer(newvalue, field, id):

    # Een variable wordt aangemaakt voor de database connectie
    containerDb = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="",
        database="containers"
    )
    # De variable 'cursor' wordt aangemaakt om code te simplificeren.
    cursor = containerDb.cursor()
    # De SQL command line wordt in een variable gezet, daarna wordt deze uitgevoerd
    # via de cursor en dan wordt de verandering gecommit. Zonder containerDb.commit()
    # is er geen aanpassing !!
    sql = "UPDATE container SET {} = '{}' WHERE ContainerID = '{}'".format(field, newvalue, id)
    cursor.execute(sql), containerDb.commit()
    print("Tabel Container '{}' veld '{}' is geüpdated met: '{}' ".format(id, field, newvalue))

#   #voorbeeld
# appendContainer(20, "Grootte", 1)
# Tabel Container '1' veld 'Grootte' is geüpdated met: '20'


