import pandas as pdd
from Db import *
import pymysql
import paramiko
import pandas as pd
from paramiko import SSHClient
from sshtunnel import SSHTunnelForwarder
from os.path import expanduser

def getAuctionToScrapingFromLocalDb():
	db = Db()
	conn = db.connDb("", "", "")
	db.testDatabase(conn)
	db.setDb(conn, "")

	imag24Db = Imag24Db()
	resultArr = imag24Db.selectJoin(conn)
	return resultArr

def getAuctionToScrapingFromLocalDb2d():
    db = Db()
    conn = db.connDb("", "", "")
    db.testDatabase(conn)
    db.setDb(conn, "")

    imag24Db = Imag24Db()
    resultArr = imag24Db.selectJoin2d(conn)
    return resultArr

def getAuctionToScrapingFromCSV(csvPath):
    colnames=['competition_auction_id'] 
    csv = pdd.read_csv("scrawle.csv", names=colnames, header=None, on_bad_lines='skip')
    print(csv)

    n = len(csv)
    auctionIdArr = []
    for row in range(0, n):
        auctionId = csv.loc[row, colnames].values
        rep = str(auctionId).replace("[", "")
        rep = str(rep).replace("]", "")
        rep = str(rep).replace("'", "")
        size = len(rep)
        rep = rep[:size - 2]
        if rep == 'n':
            continue
        auctionIdArr.append(rep)
        print(rep)

    return auctionIdArr

def getAuctionToScrapingFromSshTunel():
    mypkey = paramiko.RSAKey.from_private_key_file("/home/vel/.ssh/key", password='')
    # if you want to use ssh password use - ssh_password='your ssh password', bellow

    sql_hostname = ''
    sql_username = ''
    sql_password = ''
    sql_main_database = ''
    sql_port = 3306
    ssh_host = ''
    ssh_user = ''
    ssh_port = 5000
    sql_ip = '1.1.1.1.1'

    with SSHTunnelForwarder(
        (ssh_host, ssh_port),
        ssh_username=ssh_user,
        ssh_pkey=mypkey,
        remote_bind_address=(sql_hostname, sql_port)) as tunnel:
            conn = pymysql.connect(host='127.0.0.1', user=sql_username, passwd=sql_password, db=sql_main_database,port=tunnel.local_bind_port)
            imag24Db = Imag24Db()
            resultArr = imag24Db.selectJoin(conn)
            return resultArr
				

def getAuctionToScrapingFromSshTunel2d():
    mypkey = paramiko.RSAKey.from_private_key_file("/home/vel/.ssh/key", password='')
    # if you want to use ssh password use - ssh_password='your ssh password', bellow

    sql_hostname = 'localhost'
    sql_username = ''
    sql_password = ''
    sql_main_database = ''
    sql_port = 3306
    ssh_host = ''
    ssh_user = ''
    ssh_port = 5000
    sql_ip = '1.1.1.1.1'

    with SSHTunnelForwarder(
        (ssh_host, ssh_port),
        ssh_username=ssh_user,
        ssh_pkey=mypkey,
        remote_bind_address=(sql_hostname, sql_port)) as tunnel:
            conn = pymysql.connect(host='127.0.0.1', user=sql_username, passwd=sql_password, db=sql_main_database,port=tunnel.local_bind_port)
            imag24Db = Imag24Db()
            resultArr = imag24Db.selectJoin2d(conn)
            return resultArr