from repository.repository import Repository
from repository.utils import insert, select

from models.provider import Provider


class ProviderRepository(Repository[Provider]):
    @classmethod
    def tablename(cls) -> str:
        return "Provider"

    @classmethod
    def add(cls, item: Provider) -> int:
        rows = select(cls.tablename(), ["ID"], {"Name": item.name})
        if len(rows) > 0:
            return rows[0][0]

        return insert(
            ProviderRepository.tablename(),
            {
                "Name": item.name,
                "Icon": item.icon,
                "Link": item.link,
            },
        )
