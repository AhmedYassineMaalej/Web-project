from repository.utils import insert, select
from models.category import Category
from repository.repository import Repository


class CategoryRepository(Repository[Category]):
    @classmethod
    def tablename(cls) -> str:
        return "Category"

    @classmethod
    def add(cls, item: Category) -> int:
        rows = select(cls.tablename(), ["ID"], {"Name": item.name})

        if len(rows) > 0:
            return rows[0][0]

        return insert(
            cls.tablename(),
            {
                "Name": item.name,
            },
        )
