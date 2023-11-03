import mysql.connector 
import time
from datetime import datetime
import re

#pr_specific_price
#pr_str_allegro_auction_price 
class Imag24Db:
    def selectJoin(self, conn):
        cursor = conn.cursor()
        sql = 'SELECT a.product_id, a.competition_auction_id FROM pr_str_allegro_auction_price a, pr_specific_price sp where sp.id_product = a.product_id'
        cursor.execute(sql)
        results = cursor.fetchall()
        resultArr = [];
        for row in results:
            print(str(row[0]) + " " + row[1])
            if(row[1] == ""):
                continue

            resultArr.append(row[1])

        return resultArr

    def selectJoin2d(self, conn):
        cursor = conn.cursor()
        sql = 'SELECT a.product_id, a.competition_auction_id FROM pr_str_allegro_auction_price a, pr_specific_price sp where sp.id_product = a.product_id'
        cursor.execute(sql)
        results = cursor.fetchall()
        resultArr = [];
        for row in results:
            print(str(row[0]) + " " + row[1])
            if(row[1] == ""):
                continue

            arr = [row[0], row[1]]
            resultArr.append(arr)

        return resultArr

    def insertToPr_scrap_allegro(self, conn, lines):
        cursor = conn.cursor()
        sql = "SHOW TABLES LIKE '%pr_scrap_allegro'"
        cursor.execute(sql)
        results = cursor.fetchall()
        print(len(results));
        if(len(results) == 0):
            print("Create pr_scrap_allegro")
            sql = "create table pr_scrap_allegro (id_product int(13), scrap_time DATETIME, competition_auction_id BIGINT UNIQUE, condition_item varchar(16), price varchar(64))"
            cursor.execute(sql)
        else:
            print("Inesert")
            split = lines.split("\n")
            for s in split:
                if(s == ""):
                    break
                lineSplit = s.split(":")
                sql = "select competition_auction_id from pr_scrap_allegro where competition_auction_id = '" + lineSplit[1] + "'"
                cursor.execute(sql)
                results = cursor.fetchall()
                n = len(results)
                if(n == 0):
                    print("insert")
                    now = datetime.now()
                    now = str(now)
                    sql = "insert into pr_scrap_allegro (id_product, scrap_time, competition_auction_id, price, condition_item) values ('" + lineSplit[0] + "','" + now + "','"+ lineSplit[1] + "','" + lineSplit[2] + "','" + lineSplit[3] + "')"
                    print(sql)
                    cursor.execute(sql)
                else:
                    now = datetime.now()
                    now = str(now)
                    competition_auction_id = results[0]
                    competition_auction_id = int(re.sub(r'\D', '', str(results[0])))
                    print(competition_auction_id)
                    sql = "update pr_scrap_allegro set scrap_time='" + now + "', price='" + lineSplit[2] + "', condition_item='" + lineSplit[3] + "' where competition_auction_id = '" + str(competition_auction_id) + "'"
                    print(sql)
                    cursor.execute(sql)
                    

class Db:    
    def escapeString(self, value):
        return value.replace("'", r"\'")

    def connDb(self, host, user, passwd):
        conn = mysql.connector.connect(host = host, user = user,passwd = passwd)
        return conn

    def testDatabase(self, conn):
        query = "show databases"
        cursor = conn.cursor()
        cursor.execute(query)
        result = cursor.fetchall()
        print(cursor.statement)
        for row in result:
            print(row)

    def setDb(self, conn, db):
        cursor = conn.cursor()
        cursor.execute('USE ' + db)
