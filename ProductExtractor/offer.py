from typing import TypeVar
from category import Category
from product import Product
from provider import Provider

C = TypeVar("C", Category, None)
P = TypeVar("P", Provider, None)


class Offer[C, P]:
    def __init__(
        self,
        product: Product[C],
        provider: P,
        price: float,
        url: str,
    ):
        self.product = product
        self.provider = provider
        self.price = price
        self.url = url

    def __repr__(self) -> str:
        res = "ProductOffer(\n"
        for key, val in self.__dict__.items():
            res += f"\t{key} = {str(val)}\n"
        res += ")"
        return res

    def with_category(self, category: Category) -> "Offer[Category, P]":
        return Offer(
            self.product.with_category(category), self.provider, self.price, self.url
        )

    def with_provider(self, provider: Provider) -> "Offer[C, Provider]":
        return Offer(self.product, provider, self.price, self.url)
