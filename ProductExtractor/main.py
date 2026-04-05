from selenium.webdriver.chrome.webdriver import WebDriver as Chrome
from selenium.webdriver.firefox.webdriver import WebDriver as Firefox

from database.product_offer_repository import ProductOfferRepository

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

    for offer in offers:
        ProductOfferRepository.add(offer)


if __name__ == "__main__":
    main()
