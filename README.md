# Conditional Discount for WooCommerce

**A WordPress plugin to apply conditional discounts in your WooCommerce store — based on specific condition like minimum amount, product count, and more.**

## Table of Contents

- [Features](#features)  
- [Requirements](#requirements)  
- [Installation](#installation)  
- [Usage / Configuration](#usage--configuration)  
- [Examples](#examples)  
- [How it works (Technical)](#how-it-works-technical)  
- [Changelog](#changelog)  
- [Support](#support)  
- [License](#license)  
- [Author](#author)

---

## Features

This WordPress plugin lets you:  

- ✅ Apply discounts based on **product categories**.  
- ✅ Apply discounts based on **user roles** (e.g. give special discount to “subscriber”, “wholesale”, etc.).  
- ✅ Discount rules based on **cart total** (e.g. if cart total ≥ $100, apply discount).  
- ✅ Support for **percentage** discounts and **fixed amount** discounts.  
- ✅ A simple, easy-to-use admin interface in WordPress to manage discount rules.  
- ✅ Compatible with standard WooCommerce setup (no heavy dependencies).  

---

## Requirements

- WordPress 5.0 or higher  
- WooCommerce 4.0 or higher  
- PHP 7.4 or higher (or as specified in plugin header)  

---

## Installation

1. Download the plugin (or clone this repo).  
2. In WordPress admin: go to **Plugins › Add New › Upload Plugin**, and select the `.zip` (or use `conditional-discount.php` if manually installing).  
3. Click **Install Now**, then **Activate**.  
4. Ensure that WooCommerce is installed and active — this plugin requires WooCommerce.  

---

## Usage / Configuration

1. In WordPress Admin, go to **WooCommerce › Conditional Discounts**.  
2. Click **Add New Discount**.  
3. Configure your discount rule:  
   - Choose **Conditions** — e.g. product category, user role, cart total, etc.  
   - Choose **Discount type** — either **percentage** or **fixed amount**.  
   - Define the discount value.  
   - Enable or save the rule.  
4. Once saved, the discount rule becomes active. It will automatically apply at checkout for eligible carts/users/products.  

---

## Examples

| Scenario | Setup |
|---------|--------|
| 10% off all “Accessories” category items | Condition: Product Category = Accessories, Discount Type = 10% |
| $20 off cart if subtotal ≥ $200 | Condition: Cart Total ≥ 200, Discount Type = Fixed — $20 |
| 15% off for Wholesale users | Condition: User Role = Wholesale, Discount Type = 15% |
| Combined rule: 5% off Accessories + additional 5% for Wholesale users | Create two rules — both will apply if conditions met |

> Note: If multiple discount rules match, consider carefully how you expect discounts to stack — by default, all matching rules will apply.  

---

## How it works (Technical)

This WordPress plugin hooks into WooCommerce cart/order processes:  

- On WooCommerce cart/order hooks the plugin checks each defined discount rule.  
- It verifies whether the current cart and user meet the configured conditions (category, role, cart total, etc.).  
- If a rule matches, it applies the discount (either percentage or fixed) before final total computation.  
- Discount logic is separated in plugin files, making customization or extension straightforward.  

---

## Changelog

### 1.0.0
- Initial release  
- Basic conditional discount functionality implemented: category‑based, role‑based, cart‑total based.  
- Support for percentage and fixed‑amount discounts.  
- Admin interface to manage discount rules.  

---

## Support

If you find a bug, have a suggestion, or need help, please reach out via [shanto.net contact page](https://shanto.net/contact) — or open an issue/pull request on this GitHub repo.  

---

## License

This WordPress plugin is licensed under the [GPL‑2.0+ license](http://www.gnu.org/licenses/gpl-2.0.txt).  

---

## Author

Riadujjaman Shanto — [shanto.net](https://shanto.net)  
