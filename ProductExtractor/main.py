from selenium import webdriver
from scraper import Scraper
from workflows.mytek import workflow

import argparse


def main():
    parser = argparse.ArgumentParser()
    parser.add_argument(
        "-b", "--browser", choices=["firefox", "chrome"], default="firefox"
    )

    args = parser.parse_args()
    match args.browser:
        case "chrome":
            driver = webdriver.Chrome()
        case "firefox":
            driver = webdriver.Firefox()

    scraper = Scraper(driver)
    products = scraper.accept_workflow(workflow)
    scraper.quit()

    # to be replaced with database calls
    for prod in products:
        print(prod)


if __name__ == "__main__":
    main()
