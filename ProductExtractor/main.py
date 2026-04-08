from selenium.webdriver.chrome.webdriver import WebDriver as Chrome
from selenium.webdriver.firefox.webdriver import WebDriver as Firefox

from repository.product_offer_repository import ProductOfferRepository

from browser import Browser

from workflows.mytek import scrape_provider

import argparse


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument(
        "-b", "--browser", choices=["firefox", "chrome"], default="firefox"
    )

    args = parser.parse_args()
    match args.browser:
        case "chrome":
            driver = Chrome()
        case "firefox":
            driver = Firefox()
        case _:
            print("unsupported browser:", args.browser)
            return

    browser = Browser(driver)
    offers = browser.execute(scrape_provider)
    browser.quit()

    # to be replaced with database calls
    """
    hey, pls dont hardcode your mysql credentials, use ".env" only! copy paste .env.example into .env and modify it like your mysql credentials
    here u go:
    
    from dotenv import load_dotenv
    import os

    load_dotenv()

    HOST = os.getenv('HOST')
    DB_NAME=os.getenv('DB_NAME')
    USER = os.getenv('USER')
    PWD = os.getenv('PWD')
    """
    for prod in products:
        print(prod)


if __name__ == "__main__":
    main()
