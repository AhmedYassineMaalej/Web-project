from selenium import webdriver
from selenium.webdriver.firefox.webdriver import WebDriver

from instructions import Workflow
from product import Product


class Scraper:
    def __init__(self, driver: WebDriver):
        self.driver = driver

    def accept_workflow(self, workflow: Workflow) -> list[Product]:
        products = workflow.execute(self.driver)
        return products

    def quit(self):
        self.driver.quit()
