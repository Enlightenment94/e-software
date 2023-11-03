import pymysql
import paramiko
import pandas as pd
from paramiko import SSHClient
from sshtunnel import SSHTunnelForwarder
from os.path import expanduser

def main():
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
            conn = pymysql.connect(host='127.0.0.1', user=sql_username, passwd=sql_password, db=sql_main_database, port=tunnel.local_bind_port)
            query = "show databases"
            data = pd.read_sql_query(query, conn)
            print(data)
            conn.close()

if __name__ == "__main__":
    main()