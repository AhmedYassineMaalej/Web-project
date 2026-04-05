from database.category_repository import CategoryRepository
from database.utils import get_connection, insert, select
from product import Product
from database.repository import Repository


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
        return insert(
            cls.tablename(),
            {
                "Reference": item.reference,
                "Description": item.description,
                "Image": item.image,
                "CategoryID": category_id,
            },
        )
