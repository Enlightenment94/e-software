#!/usr/bin/python3
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait 

from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import TimeoutException

import time
from datetime import datetime
import pandas as pd
from requests import get
import os
import random
import sys

from screen import *
from input import *
from output import *
from browserConfig import *
from validate import *

def scrapParametr(browser, link):
    #screen detect
    print("Detect screen")
    #W zależności od szybkości internetu
    #timeOut = random.randrange(15, 23)
    timeOut = random.randrange(90, 100)
    try:
        #browser.set_page_load_timeout(timeOut)
        browser.set_page_load_timeout(timeOut)
        #selenium.common.exceptions.TimeoutException: Message: Navigation timed out after 15000 ms
    except Exception as e:
        print("Time out " + str(timeOut))
        
    browser.get(link)

    #WARRNING !!!!!!
    captcha = ""
    captcha = pleaseEnableJSScreen(browser)
    if(captcha == "captcha"):
        sys.exit(captcha);

    browser.delete_all_cookies()
    #serverNotFoundScreen(browser)
    browser.delete_all_cookies()
    captchaScreen(browser)
    browser.delete_all_cookies()

    try:
        new = browser.find_element("xpath" , "//td[contains(.,'Nowy')]")
        new = 'Nowy'
    except NoSuchElementException as e:
        new = 0
    try:
        used = browser.find_element("xpath" , "//td[contains(.,'Używany')]")
        used = 'Używany'
    except NoSuchElementException as e:
        used = 0
    
    conditionItem = "null"
    if(new  == 'Nowy'):
        conditionItem = new

    if(used == 'Używany'):
        conditionItem = used

    #print("Nowy:")
    #print(new)
    #print("Używany:")
    #print(used)

    try:
        whole = browser.find_element(By.XPATH, "//div[@class='mryx_16']//span")
    except NoSuchElementException as e:
        whole = "blocked"

    try:
        afterDot = browser.find_element(By.XPATH, "//div[@class='mryx_16']//span[2]")
    except NoSuchElementException as e:
        afterDot = " blocked or not write"

    if(whole == "blocked" ):
        print(whole + afterDot)
        print("")
        return whole
    else:
        print(whole.text + afterDot.text + ":" + conditionItem)
        print("")
        return whole.text + afterDot.text + ":" + conditionItem

    return "err"

def scrawleWindScribe(queueFile, browser, auctionIdArr, rows, counterEnd , vpn):
    print(rows)

    auctionId = ""
    rep = ""
    size = ""

    #vpnArr = ['Atlanta', 'Dallas', 'Frankfurt', 'Amsterdam' , 'Paris', 'Bucharest', 'Zurich', 'London', 'Istanbul', 'Honk Kong']

    vpnArr = ['Atlanta', 'Dallas', 'Frankfurt', 'Amsterdam' , 'Paris', 'Bucharest', 'Zurich', 'London', 'Istanbul', 'Honk Kong', 'Brussels', 'Vienna', 'Sofia', 'Zagreb' , 'Nicosia', 'Prague', 'Copenhagen', 'Tallinn','Helsinki', 'Athens','Budapest','Reykjavik']
    randVpn = random.choice(vpnArr)

    if(vpn == "on"):
        os.system("/opt/windscribe/windscribe-cli connect " + randVpn)
        os.system("/opt/windscribe/windscribe-cli firewall off" )

    #ip = get('https://api.ipify.org').text
    #print('My public IP address is: {}'.format(ip))

    vpnArrCounterEnd = len(vpnArr)
    vpnArrCounter = random.randrange(0, vpnArrCounterEnd - 1)

    counter = 0
    blockFlagOrRes = ""

    for row in range(1, rows):
        if(vpn == "always"):
            vpnArrCounter = 0
            vpnArrCounter = random.randrange(0, vpnArrCounterEnd - 1)
            os.system("/opt/windscribe/windscribe-cli connect " + vpnArr[vpnArrCounter])
            os.system("/opt/windscribe/windscribe-cli firewall off" )
            print("")

        if(blockFlagOrRes == "blocked"):
            counter = counterEnd
            #browser.get("https://search.brave.com/")

        if(counter == counterEnd):
            if(vpnArrCounter == vpnArrCounterEnd):
                vpnArrCounter = 0
                vpnArrCounter = random.randrange(0, vpnArrCounterEnd - 1)

            if(vpn == "on"):
                os.system("/opt/windscribe/windscribe-cli connect " + vpnArr[vpnArrCounter])
                os.system("/opt/windscribe/windscribe-cli firewall off" )
                print("")
                #ip = get('https://api.ipify.org').text
                #print('My public IP address is: {}'.format(ip))
                counter = 0
                vpnArrCounter += 1

        rep = auctionIdArr[row]
        print(str(row) + " " + rep)
        if rep == "n":
            continue
        else:
            print("Scrap " + "https://allegro.pl/listing?string=" + rep)
            #Zakomnetuj jeśli chcesz by po timeout zakończył
            try:
                blockFlagOrRes = scrapParametr(browser, "https://allegro.pl/listing?string=" + rep)
            except TimeoutException as te:
                print("Time except")
                print(te)

            if blockFlagOrRes != "blocked":
                f = open(queueFile, "r")
                content = f.read()
                f.close()

                try:
                    content.index(rep)
                    print("Found!" + blockFlagOrRes)
                except ValueError:
                    print("Not found!")
                    f = open(queueFile, "a")
                    f.write(rep + ":" + blockFlagOrRes + "\n")
                    f.close()

            counter += 1


def main():
    time.sleep(3)

    #auctionIdArr = getAuctionToScrapingFromCSV("scrawle.csv")
    #auctionIdArr = list(set(auctionIdArr))
    #auctionIdArr = getAuctionToScrapingFromLocalDb()
    auctionIdArr = getAuctionToScrapingFromSshTunel()
    
    queueFile = "queue/scrawled.txt"
    if os.path.exists(queueFile):
        f = open(queueFile, "r")
        content = f.read()
        f.close()
    else:
        f = open(queueFile, "w")
        content = "";
        f.close()

    print("")
    n = len(auctionIdArr)
    arrToRemove = []
    for x in range(0, n):
        if auctionIdArr[x] in content:
            print("Found! " + auctionIdArr[x])
            #arrToRemove.append(x)
            arrToRemove.append(auctionIdArr[x])
        #else:
        #    print("Not found!" + auctionIdArr[x])

    print("Here")
    n = len(arrToRemove)
    print(len(auctionIdArr))
    x = 0
    for x in range(0, n):
        print(arrToRemove[x])
        auctionIdArr.remove(arrToRemove[x])

    print(len(auctionIdArr))
    print(len(arrToRemove))

    flag = "on"
    if(len(auctionIdArr) <= 1 and flag == "on"):
        print("Scrap is end");
        now = datetime.now()
        now = str(now)
        now = now.replace(" ", "-")
        print(now)

        #auctionArr = getAuctionToScrapingFromLocalDb2d()
        auctionArr = getAuctionToScrapingFromSshTunel2d()

        endScrapFile = "queue/end-" + now;

        for row in auctionArr:
            print(str(row[0]) + " " + row[1])

        lines = []
        with open(queueFile) as file:
            for line in file:
                lines.append(line.strip())

        newFile = ""
        newLine = ""
        for line in lines:
            newLine = ""
            el = line.split(":")

            if(el[1] == ""):
                continue

            for row in auctionArr:
                if row[1] == el[0]:
                    print(row[1] + " =? " + el[0]);
                    newLine = str(row[0]) + ":" + row[1] + ":" + el[1] + ":" + el[2]

            validateLine = validate(line);
            if (validateLine == 1):
                print(line + " -> " + newLine)
                print("\033[92m" + line + " -> " + newLine + "\033[0m")
                newFile += newLine + "\n"
            else:
                print("\033[91m" + line + " -> " + newLine + "\033[0m")
                ##print(line + " -> " + newLine)

            print("")


        #addPr_scrap_allegro(newFile)
        #addToPr_scrap_allegroSsh()
        #f = open(endScrapFile, "w")
        #content = "";
        #f.close()

        exit()
    
    #chroma to nie lubi wogóle prawie
    #browser = chrome1()
    #browser = chromeIncognito()
    #firefox inconginto dobrze jeśli below 20
    browser = firefoxIncognito()
    #browser = firefoxIncognitoProxy()
    #browser = firefoxIncognitoRandomAgent()
    #browser = firefoxIncognitoRandomAgentMy()

    browser_info_script = "return window.navigator.userAgent"
    browser_info = browser.execute_script(browser_info_script)

    print("Sygnatura przeglądarki to:", browser_info)

    debugBrowser = "off"
    if debugBrowser == "on":
        browser.get("https://bot.sannysoft.com")
        time.sleep(2)
        #browser.set_page_load_timeout(60)

        browser.get("https://nordvpn.com/pl/what-is-my-ip")
        time.sleep(2)

        browser.get("https://useragentstring.com/")
        time.sleep(2)

    #przy 20 szaleje
    #surf = random.randrange(6, 8)
    surf = random.randrange(11, 15)
    #surf = 25
    print("Web to scrap " + str(surf))

    scrawleWindScribe(queueFile, browser, auctionIdArr, surf, 5, "off")

    clock = random.randrange(13, 26, 2)
    print("clock")
    print(clock)
    time.sleep(clock)
    browser.close()
    browser.quit()
    sys.exit("Correct")

if __name__ == "__main__":
    main()


