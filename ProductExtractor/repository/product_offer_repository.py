from repository.provider_repository import ProviderRepository
from repository.repository import Repository
from repository.utils import insert, select
from repository.product_repository import ProductRepository

from models.offer import Offer


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
                "Link": item.link,
                "Price": item.price,
                "ProviderID": provider_id,
            },
        )
