#!/usr/bin/python3
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait 
from selenium.webdriver.firefox.options import Options
from selenium_stealth import stealth
from selenium.webdriver.common.keys import Keys
from fake_useragent import UserAgent
from selenium.common.exceptions import NoSuchElementException
from selenium.common.exceptions import TimeoutException

import time
from datetime import datetime
import pandas as pd
from requests import get
import os
import random
import sys
import numpy as np

from anticaptchaofficial.antigatetask import *
from aiCaptcha import *

def breakAntiCaptcha():
	# STOP! IMPORTANT! Read paragraph 2 above!
	proxy_host = "11.11.11.11"
	proxy_port = 1234
	proxy_login = "login"
	proxy_pass = "password"

	proxies = {
	    'https': f"http://{proxy_login}:{proxy_pass}@{proxy_host}:{proxy_port}",
	    'http': f"http://{proxy_login}:{proxy_pass}@{proxy_host}:{proxy_port}"
	}


	link = "https://geo.captcha-delivery.com/captcha/?initialCid=AHrlqAAAAAMA0QqekceaNGAAUt2LJw%3D%3D&hash=77DC0FFBAA0B77570F6B414F8E5BDB&cid=3L8-geq4_LMIQdNgqoX72tdRyu7Qq3oS71BVPy2EG3w6GFlEUSTf5xWbzCRhU3qrbcjIw7bXnmVfIw-lallAFkKd5z~KoU90PGB-lTt94547bhw-4~WeudTt3GnO44uD&t=fe&referer=https%3A%2F%2Fallegro.pl%2Flisting%3Fstring%3D13596492754&s=29560&e=d06af6bf5e7ef07957dfd2044d18de29b6553b453e04c699529d015dbc64cd7e"
	solver = antibotcookieTask()
	solver.set_verbose(1)
	solver.set_key("API_KEY_HERE")
	solver.set_website_url("link")
	solver.set_proxy_address(proxy_host)
	solver.set_proxy_port(proxy_port)
	solver.set_proxy_login(proxy_login)
	solver.set_proxy_password(proxy_pass)


	result = solver.solve_and_return_solution()
	if result == 0:
	    print("could not solve task")
	    exit()

	print(result)

	cookies, localStorage, fingerprint = result["cookies"], result["localStorage"], result["fingerprint"]

	if len(cookies) == 0:
	    print("empty cookies, try again")
	    exit()

	cookie_string = '; '.join([f'{key}={value}' for key, value in cookies.items()])
	user_agent = fingerprint['self.navigator.userAgent']
	print(f"use these cookies for requests: {cookie_string}")
	print(f"use this user-agent for requests: {user_agent}")

	s = requests.Session()
	proxies = {
	  "http": f"http://{proxy_login}:{proxy_pass}@{proxy_host}:{proxy_port}",
	  "https": f"http://{proxy_login}:{proxy_pass}@{proxy_host}:{proxy_port}"
	}
	s.proxies = proxies

	content = s.get(link, headers={
	    "Cookie": cookie_string,
	    "User-Agent": user_agent
	}).text

	print(content)

def main():
	"""
	link = "https://geo.captcha-delivery.com/captcha/?initialCid=AHrlqAAAAAMA0QqekceaNGAAUt2LJw%3D%3D&hash=77DC0FFBAA0B77570F6B414F8E5BDB&cid=3L8-geq4_LMIQdNgqoX72tdRyu7Qq3oS71BVPy2EG3w6GFlEUSTf5xWbzCRhU3qrbcjIw7bXnmVfIw-lallAFkKd5z~KoU90PGB-lTt94547bhw-4~WeudTt3GnO44uD&t=fe&referer=https%3A%2F%2Fallegro.pl%2Flisting%3Fstring%3D13596492754&s=29560&e=d06af6bf5e7ef07957dfd2044d18de29b6553b453e04c699529d015dbc64cd7e"


	options = webdriver.ChromeOptions()
	options.add_argument("--incognito")
	browser = webdriver.Chrome(options=options)
	browser.get(link)
	#el = browser.find_element(By.CLASS_NAME, 'canvas-mask')
	el = browser.find_element(By.TAG_NAME, 'canvas')
	#el.screenshot("screen.png")
	print(el)

	mainPath = './allegro_captcha_img'
	files = os.listdir('./allegro_captcha_img')
	if(len(files) == 0):
		lastDigit = 0
	else:	
		lastFile = max(files, key=lambda x: int(x.split('.')[0]))
		lastDigit = int(lastFile.split('.')[0])
		lastDigit += 1

	el.screenshot("./allegro_captcha_img/" + str(lastDigit) + ".png")
"""
	mainPath = './allegro_captcha_img'
	print(mainPath)
	breakCaptch(mainPath + "/" + "1.png")
	breakCaptch1("./tmp/1.png", 2)

if __name__ == "__main__":
    main()
