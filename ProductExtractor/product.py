from category import Category


class Product[C]:
    def __init__(
        self,
        reference: str,
        name: str,
        image: str,
        description: str,
        info: dict[str, str],
        category: C = None,
    ):
        self.reference = reference
        self.name = name
        self.image = image
        self.description = description
        self.category = category
        self.info = info

    def __repr__(self) -> str:
        res = "Product(\n"
        for key, val in self.__dict__.items():
            res += f"\t{key} = {str(val)}\n"
        res += ")"
        return res

    def with_category(self, category: Category) -> "Product[Category]":
        return Product(
            self.reference, self.name, self.image, self.description, self.info, category
        )
