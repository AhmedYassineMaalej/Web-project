> The app runs with the command ```php -S localhost:8000 -t public```

- the controllers call a method from the class ProductRepository (that must be filled by whoever is making that class with the appropriate method names)
- controllers call the static method from the class **ProductRepository** and EXPECT to receive a ```list of tuples each containing 3 fields``` : **[Product_Reference, Description, ImageLink]**

- we expect ```UserRepository``` and ```ProductRepository``` to be both at **App\models\\**
### App\Models\ProductRepository
- `getAllProducts()`
- `getDailyDeal()`
- `getBestDeals()`
- `getExpiringDeals()`
- `getNewestDeals()`

### App\Models\UserRepository

- `getUserByUsername($username)` -> returns the password (its already hashed bc i gave it to createUser hashed in the 1st place)

- `createUser($username, $hashed_password)`
- `getUserById($id)`

---

**Note:**
- Product methods must return: `[$ref, $description, $imageLink]`
- `getUserByUsername` must return the **Bcrypt hash** (Cost: 10)
- All methods must be **`public static`**


- Also passwords in the database must be hashed with **bcrypt** algorithm with exactly 10 rounds

- consider adding more configs in .env for the database part