from typing import NamedTuple
from repository.utils import insert, select
from repository.repository import Repository


class ProductInfo(NamedTuple):
    product_id: int
    key: str
    value: str


class ProductInfoRepository(Repository[ProductInfo]):
    @classmethod
    def tablename(cls) -> str:
        return "ProductInfo"

    @classmethod
    def add(cls, item: ProductInfo) -> int:
        rows = select(
            cls.tablename(),
            ["`Key`"],
            {
                "ProductID": item.product_id,
                "`Key`": item.key,
            },
        )

        if len(rows) > 0:
            return rows[0][0]

        return insert(
            cls.tablename(),
            {
                "ProductID": item.product_id,
                "`Key`": item.key,
                "Value": item.value,
            },
        )
