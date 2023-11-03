from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.wait import WebDriverWait 

from selenium.webdriver.firefox.options import Options
from selenium_stealth import stealth
from selenium.webdriver.common.keys import Keys
from fake_useragent import UserAgent

def firefoxIncognito():
    options = Options()
    options.add_argument("--private")
    #options.add_argument("--headless")
    print(options)
    browser = webdriver.Firefox(options=options)
    return browser

def firefoxIncognitoRandomAgent():
    options = Options()
    options.add_argument("--private")
    # nie prawdziwych agentów daje
    ua = UserAgent()
    userAgent = ua.random
    print("UserAgent")
    print(userAgent)
    #options.add_argument(f'user-agent={userAgent}')
    options.set_preference("general.useragent.override", "userAgent=" + userAgent)
    print("OPTIONS")
    print(options)
    browser = webdriver.Firefox(options=options)
    return browser

def firefoxIncognitoRandomAgentMy():
    options = Options()
    options.add_argument("--private")
    # nie prawdziwych agentów daje

    agent = 1
    if(agent == 1):
        userAgent = "Mozilla/5.0 (X11; Linux x86_64; rv:109.0) Gecko/20100101 Firefox/115.0"

    if(agent == 2):
        userAgent = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/115.0.0.0 Safari/537.36"

    print("UserAgent")
    print(userAgent)
    #options.add_argument(f'user-agent={userAgent}')
    options.set_preference("general.useragent.override", "userAgent=" + userAgent)
    print("OPTIONS")
    print(options)
    browser = webdriver.Firefox(options=options)
    return browser

def firefoxIncognitoProxy():
    #proxy_host = "71.14.23.121"
    #proxy_port = 8080

    #proxy_host = "95.66.138.21"
    #proxy_port = 8880

    proxy_host = "91.200.163.190"
    proxy_port = 8088

    # 0 – direct connection, 1 – manual proxy configuration, 2 – proxy auto-configuration (PAC)
    options = Options()
    options.add_argument("--private")
    #options.set_preference('network.proxy.type', 1)
    #options.set_preference('network.proxy.socks', proxy_host)
    #options.set_preference('network.proxy.socks_port', int(proxy_port))

    options.set_preference("network.proxy.type", 1)
    options.set_preference("network.proxy.http", proxy_host)
    options.set_preference("network.proxy.http_port", proxy_port)
    #options.add_argument("--ssl-protocol=any")
    options.set_preference("network.proxy.ssl", proxy_host)
    options.set_preference("network.proxy.ssl_port", proxy_port)

    browser = webdriver.Firefox(options=options)
    return browser

def chromeIncognito():
    options = webdriver.ChromeOptions()
    options.add_argument("--incognito")
    browser = webdriver.Chrome(options=options)
    return browser

def chromeIncognitoStelath():
    options = webdriver.ChromeOptions()
    options.add_argument('--profile-directory=Default')
    options.add_argument("--incognito")
    options.add_argument("--disable-plugins-discovery");
    browser = webdriver.Chrome(options=options)
    stealth(browser,
        languages=["pl-PL", "pl"],
        vendor="Google Inc.",
        platform="Linux x86_64",
        webgl_vendor="Intel Inc.",
        renderer="Intel Iris OpenGL Engine",
        fix_hairline=True,
    )
    browser.delete_all_cookies()
    return browser

def chrome1():
    options = webdriver.ChromeOptions()
    extension_id = "ifibfemgeogfhoebkmokieepdoobkbpo"
    options.add_argument('--profile-directory=Default')
    options.add_argument("--incognito")
    options.add_argument("--disable-plugins-discovery");
    options.add_argument("--start-maximized")
    ua = UserAgent()
    userAgent = ua.random
    print(userAgent)
    options.add_argument(f'user-agent={userAgent}')
    #options.add_argument('--load-extension=' + "./ifibfemgeogfhoebkmokieepdoobkbpo/3.4.0_0/")
    browser = webdriver.Chrome(options=options)
    #chrome-extension://ifibfemgeogfhoebkmokieepdoobkbpo/options/options.html

    stealth(browser,
        languages=["en-US", "en"],
        vendor="Google Inc.",
        platform="Linux x86_64",
        webgl_vendor="Intel Inc.",
        renderer="Intel Iris OpenGL Engine",
        fix_hairline=True,
    )

    browser.delete_all_cookies()
    browser.get("chrome-extension://ifibfemgeogfhoebkmokieepdoobkbpo/options/options.html")
    time.sleep(2)
    #browser.set_window_size(800,800)
    #browser.set_window_position(0,0)

    try:
        inp = browser.find_element(By.TAG_NAME, "input")
        api.send_keys("bb2987a67d7e7c78b4b6795111e798e7")
    except Exception as e:
        print("Api by tag err")
        print(e)

    try:
        api = browser.find_element(By.NAME, "apiKey")
        api.send_keys("bb2987a67d7e7c78b4b6795111e798e7")
    except Exception as e:
        print("Api by name err")
        print(e)

    try:
        btn = browser.find_element(By.TAG_NAME, "button")
        btn.click()
        btn.send_keys(Keys.COMMAND + 'W')
    except Exception as e:
        print("Api by tag err")
        print(e)

    browser.get("https://bot.sannysoft.com/")
    time.sleep(10)
    #browser.find_element(By.TAG_NAME, 'body').send_keys(Keys.COMMAND + 'W')
    return browser
