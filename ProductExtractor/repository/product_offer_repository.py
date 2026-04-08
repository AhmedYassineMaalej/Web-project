from database.provider_repository import ProviderRepository
from database.repository import Repository
from database.utils import insert, select
from database.product_repository import ProductRepository

from offer import Offer


class ProductOfferRepository(Repository[Offer]):
    @classmethod
    def tablename(cls) -> str:
        return "ProductOffer"

    @classmethod
    def add(cls, item: Offer) -> int:
        provider_id = ProviderRepository.add(item.provider)
        product_id = ProductRepository.add(item.product)

        rows = select(
            cls.tablename(),
            ["ID"],
            {
                "ProductID": product_id,
                "ProviderID": provider_id,
            },
        )

        # check if offer already exists
        if len(rows) > 0:
            return rows[0][0]

        return insert(
            cls.tablename(),
            {
                "ProductID": product_id,
                "Link": item.url,
                "Price": item.price,
                "ProviderID": provider_id,
            },
        )
