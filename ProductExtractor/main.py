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
