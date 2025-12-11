# Conditional Discount for WooCommerce

**Conditional Discount for WooCommerce** is a lightweight and modular WordPress plugin that allows store owners to apply smart, rule-based discounts to WooCommerce products during cart and checkout.  
You can create unlimited discount rules based on product conditions, cart totals, user details, and more.

This plugin is fully OOP-based, uses a namespace-driven architecture, follows the Singleton pattern, and includes an autoloader for clean, scalable development.

![Plugin Screenshot](assets/media/screenshot.png)

---

## Features

- Apply **conditional cart discounts**  
- Create unlimited discount rules  
- Lightweight, clean, and modular code structure  
- Uses **namespaces + autoloader**  
- Follows the **Singleton design pattern**  
- WooCommerce-friendly architecture  
- Easy to extend with custom conditions  
- No unnecessary scripts or assets loaded on the frontend

---

## Plugin Architecture

### **1. Namespaces**
Improves readability and prevents function/class conflicts.

Namespaces used:
```
Shanto\ConditionalDiscount
Shanto\ConditionalDiscount\App
Shanto\ConditionalDiscount\App\Traits
```

---

### **2. Autoloader**
Loads all classes automatically based on folder structure:

```
includes/
  App/
    Traits/
```

No manual includes required.

---

### **3. Singleton Pattern**
Every major class uses a `Singleton` trait:

```php
trait Singleton {
    private static $instance = null;

    public static function instance(){
        if (! self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }
}
```

Ensures only one instance of each module runs.

---

## Installation

1. Download the plugin or clone the repository:
   ```bash
   git clone https://github.com/shanto-w3dev/Conditional-Discount-for-WooCommerce.git
   ```

2. Place the folder inside:
   ```
   wp-content/plugins/
   ```

3. Activate **Conditional Discount for WooCommerce** from the WordPress Plugins screen.

---

## Example Usage

The plugin automatically applies:

- A cart discount if cart subtotal exceeds a specific condition  
- Discounts through WooCommerce's fee API  

---

## Hooks Used

### **WooCommerce Hooks**
| Hook | Purpose |
|------|---------|
| `woocommerce_cart_calculate_fees` | Applies discount dynamically |

### **WordPress Hooks**
| Hook | Purpose |
|------|---------|
| `plugins_loaded` | Initializes plugin |

---

## License

This plugin is open-source and licensed under the **GPL v2 License**.

---

## Contributing

Pull requests are welcome!  
If you find bugs or want new features, feel free to open an issue in the repo.

---

## Author

**Riadujjaman Shanto**  
WordPress Developer  
GitHub: https://github.com/shanto-w3dev
