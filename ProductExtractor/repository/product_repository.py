from repository.category_repository import CategoryRepository
from repository.product_info_repository import ProductInfo, ProductInfoRepository
from repository.utils import insert, select
from models.product import Product
from repository.repository import Repository


class ProductRepository(Repository[Product]):
    @classmethod
    def tablename(cls):
        return "Product"

    @classmethod
    def add(cls, item: Product) -> int:
        rows = select(cls.tablename(), ["ID"], {"Reference": item.reference})

        if len(rows) == 1:
            return rows[0][0]

        category_id = CategoryRepository.add(item.category)
        product_id = insert(
            cls.tablename(),
            {
                "Reference": item.reference,
                "Description": item.description,
                "Image": item.image,
                "CategoryID": category_id,
            },
        )

        for key, val in item.info.items():
            ProductInfoRepository.add(ProductInfo(product_id, key, val))

        return product_id
