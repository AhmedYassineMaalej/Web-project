from instructions import Workflow, ScrapeInstruction


def process_price(price: str) -> float:
    price = price.strip().removesuffix(" DT").replace(",", ".")
    price = price.replace("\u202f", "")
    return float(price)


def process_reference(price: str) -> str:
    return price.removeprefix("[").removesuffix("]")


workflow = Workflow(
    "https://www.mytek.tn/informatique/composants-informatique/barrettes-memoire.html",
    price_instruction=ScrapeInstruction(
        ".product-container span.final-price", "innerHTML", process_price
    ),
    name_instruction=ScrapeInstruction(
        ".product-container a.product-item-link", "innerHTML", str.strip
    ),
    image_instruction=ScrapeInstruction(
        ".product-container .product-item-photo img", "src"
    ),
    url_instruction=ScrapeInstruction(
        ".product-container a.product-item-link",
        "href",
    ),
    reference_instruction=ScrapeInstruction(
        ".product-container .sku", "innerHTML", process_reference
    ),
)
