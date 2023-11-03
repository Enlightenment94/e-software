import time

#Scren - Please enable JS and disable any ad blocker
def pleaseEnableJSScreen(browser):
    #Please enable JS and disable any ad blocker
    try:
        browser.page_source.index("Please enable JS and disable any ad blocker")
        print("Please enable JS and disable any ad blocker - ON");
        time.sleep(10000000)
        return "captcha"
    except ValueError:
        print("Please enable JS and disable any ad blocker - page_source err")

    try:
        err = browser.find_element(By.ID, "cmsg")
        print(err.text)
        if err.text == "Please enable JS and disable any ad blocker":
            browser.get("https://search.brave.com/")
            print("Please enable JS and disable any ad blocker - ON");

    except Exception as e:
        print("screen - Please enable JS and disable any ad blocker - cmsg err")
    
    try:
        p = browser.find_element(By.TAG_NAME, "p")
        if p.text == "Please enable JS and disable any ad blocker":
            browser.get("https://search.brave.com/")
    except Exception as e:
        print("screen - Please enable JS and disable any ad blocker - p err")

    try:
        title = browser.find_element(By.XPATH,'//div[@class="msub_k4"]//h4').text
        print("LOL")
        print(title)
    except Exception as e:
        print("LOL except")
        print(e)
        

#Server Not found screen
def serverNotFoundScreen(browser):
    print(browser.title)
    if "Server Not Found" == browser.title:
        print(browser.title)
        try:
            btn = browser.find_element(By.ID, "neterrorTryAgainButton")
            print(btn)
            btn.click()

            prop = btn.get_property('disabled')
            if prop == True:
                print(prop)
                a = browser.find_element(By.TAG_NAME, "a")
                a.click()

            print("Screen - Server not found - ON")

        except Exception as e:
            print("Screen - Server not found - err a")



# Confirm you are a human. 
def captchaScreen(browser):
    try:
        browser.page_source.index("Confirm you are a human")
        print("Confirm you are a human - ON")
    except ValueError:
        print("Confirm you are a human - OFF")

    try:
        browser.page_source.index("Potwierdź, że jesteś człowiekiem.")
        print("Potwierdź, że jesteś człowiekiem. - ON")
    except ValueError:
        print("Confirm you are a human - OFF")
                    
    try:
        print(browser.title)
        if "allegro.pl" == browser.title:
            print("allegro.pl equal")
            print("page len " + str(len(browser.page_source)))
            time.sleep(10) #3538
            print("page len " + str(len(browser.page_source)))

        if "Confirm you are a human" in browser.page_source:
            print("captcha")

        captcha = browser.find_element("xpath" , "//div[@class='captcha__human__title']")
    except Exception as e:
        print("Screen - Captcha - body err")
