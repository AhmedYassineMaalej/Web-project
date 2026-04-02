from abc import ABC, abstractmethod
from typing import Callable, Optional

from selenium.common import TimeoutException
from selenium.webdriver.common.by import By
from selenium.webdriver.firefox.webdriver import WebDriver
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.support.ui import WebDriverWait

from product import Product


class Instruction[T](ABC):
    @abstractmethod
    def execute(self, driver: WebDriver) -> T:
        pass


class OpenInstruction(Instruction[None]):
    def __init__(self, url: str):
        self.url = url

    def execute(self, driver: WebDriver) -> None:
        driver.get(self.url)


type Processing[T] = Callable[[str], T]


class ScrapeInstruction[T](Instruction[list[T]]):
    def __init__(
        self,
        selector: str,
        attribute_name: str,
        processing: Optional[Processing[T]] = None,
    ):
        self.selector = selector
        self.attribute_name = attribute_name
        self.processing = processing

    def execute(self, driver: WebDriver) -> list[T]:
        try:
            elements = WebDriverWait(driver, 5).until(
                EC.presence_of_all_elements_located((By.CSS_SELECTOR, self.selector))
            )
        except TimeoutException:
            print("selector didnt match:", self.selector)
            return []

        data = []
        for elem in elements:
            datum = elem.get_attribute(self.attribute_name)
            if datum is None:
                continue

            if self.processing:
                datum = self.processing(datum)

            data.append(datum)

        return data


class Workflow(Instruction):
    def __init__(
        self,
        url: str,
        price_instruction: ScrapeInstruction[float],
        name_instruction: ScrapeInstruction[str],
        url_instruction: ScrapeInstruction[str],
        image_instruction: ScrapeInstruction[str],
        reference_instruction: ScrapeInstruction[str],
    ):
        self.open_instruction = OpenInstruction(url)
        self.price_instruction = price_instruction
        self.name_instruction = name_instruction
        self.url_instruction = url_instruction
        self.image_instruction = image_instruction
        self.reference_instruction = reference_instruction

    def execute(self, driver: WebDriver) -> list[Product]:
        self.open_instruction.execute(driver)
        prices = self.price_instruction.execute(driver)
        names = self.name_instruction.execute(driver)
        urls = self.url_instruction.execute(driver)
        images = self.image_instruction.execute(driver)
        references = self.reference_instruction.execute(driver)

        products = []
        for price, name, url, image, ref in zip(
            prices, names, urls, images, references
        ):
            product = Product(ref, name, image, price, url)
            products.append(product)

        return products
