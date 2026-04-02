class Product:
    def __init__(self, reference: str, name: str, image: str, price: float, url: str):
        self.reference = reference
        self.name = name
        self.image = image
        self.price = price
        self.url = url
        self.info: dict[str, str] = dict()

    def __repr__(self) -> str:
        res = "Product(\n"
        for key, val in self.__dict__.items():
            res += f"\t{key} = {str(val)}\n"
        res += ")"
        return res
