if the user is not logged in -> home page has buttons to sign up and login only and the other routes like catalog and myspace are forbidden

if the user is logged in -> he has access them + he sees a welcome message on top with his name (on a low level, we decode his JWT cookie and extract the name after verifying integrity)

**regardless of the user being logged in or not logged in, he sees in the home page some best deals that encourage him to make an account and join:**
Therefore i need the following methods to show on the home page since it's the only spot a user can actually see some best deals products

### App\Models\ProductRepository
- `getAllProducts()`
- `getDailyDeal()`
- `getBestDeals()`
- `getExpiringDeals()`
- `getNewestDeals()`

**Note:**
- Product methods must return: `[$ref, $description, $imageLink]`
- `getUserByUsername` must return the **Bcrypt hash** (Cost: 10)
- All methods must be **`public static`**

