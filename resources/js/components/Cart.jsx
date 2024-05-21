import React, { Component } from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';
import Swal from 'sweetalert2';
import { sum, debounce } from 'lodash';
import jsPDF from 'jspdf';
import './Cart';

class Cart extends Component {
    constructor(props) {
        super(props);
        this.state = {
            cart: [],
            barcode: '',
            paidAmount: '',
            balance: '',
            products: [],
            customers: [],
            search: '',
            customer_id: ''
        };
        this.loadCart = this.loadCart.bind(this);
        this.loadProducts = this.loadProducts.bind(this);
        this.handleOnChangeBarcode = this.handleOnChangeBarcode.bind(this);
        this.handleScanBarcode = this.handleScanBarcode.bind(this);
        this.handlePaidAmountChange = this.handlePaidAmountChange.bind(this);
        this.handleOnChangeQuantity = this.handleOnChangeQuantity.bind(this);
        this.handleClickDelete = this.handleClickDelete.bind(this);
        this.handleEmptyCart = this.handleEmptyCart.bind(this);
        this.handleSearchProduct = this.handleSearchProduct.bind(this);
        this.handleSearch = debounce(this.handleSearch.bind(this), 300);
        this.handleAddToCart = this.handleAddToCart.bind(this);
        this.setCustomerId = this.setCustomerId.bind(this);
        this.handleClickSubmit = this.handleClickSubmit.bind(this);
        this.generatePDF = this.generatePDF.bind(this);
    }

    componentDidMount() {
        this.loadCart();
        this.loadProducts();
        this.loadCustomers();
    }

    loadCustomers() {
        axios.get('/admin/customers')
            .then((res) => {
                const customers = res.data;
                this.setState({ customers });
            })
            .catch(error => {
                console.error(error);
                Swal.fire(
                    'Error',
                    'Failed to load customers',
                    'error'
                );
            });
    }

    loadProducts(search = '') {
        const query = search ? `?search=${search}` : '';
        axios.get(`/admin/products${query}`)
            .then((res) => {
                const products = res.data.data;
                this.setState({ products });
            })
            .catch(error => {
                console.error(error);
                Swal.fire(
                    'Error',
                    'Failed to load products',
                    'error'
                );
            });
    }

    handleOnChangeBarcode(event) {
        const barcode = event.target.value;
        this.setState({ barcode });
    }

    loadCart() {
        axios.get("/admin/cart")
            .then((res) => {
                const cart = res.data;
                this.setState({ cart }, this.updateBalance);
            })
            .catch(error => {
                console.error(error);
                Swal.fire(
                    'Error',
                    'Failed to load cart',
                    'error'
                );
            });
    }

    handleScanBarcode(event) {
        event.preventDefault();
        const { barcode } = this.state;
        if (barcode) {
            this.handleAddToCart(barcode);
        }
    }

    handlePaidAmountChange(event) {
        const paidAmount = event.target.value;
        this.setState({ paidAmount }, this.updateBalance);
    }

    handleOnChangeQuantity(product_id, quantity) {
        const cart = this.state.cart.map(c => {
            if (c.id === product_id) {
                return {
                    ...c,
                    pivot: {
                        ...c.pivot,
                        quantity: Number(quantity)
                    }
                };
            }
            return c;
        });
        this.setState({ cart }, this.updateBalance);
        axios.post('/admin/cart/changeQuantity', { product_id, quantity })
            .then(res => { })
            .catch(error => {
                Swal.fire(
                    'Error',
                    error.response.data.message,
                    'error'
                );
                this.loadCart();
            });
    }

    getTotal(cart) {
        return sum(cart.map(c => c.price * c.pivot.quantity)).toFixed(2);
    }

    updateBalance() {
        const total = parseFloat(this.getTotal(this.state.cart));
        const paidAmount = parseFloat(this.state.paidAmount) || 0;
        const balance = (paidAmount - total).toFixed(2);
        this.setState({ balance });
    }

    handleClickDelete(product_id) {
        axios.delete(`/admin/cart/${product_id}`)
            .then(res => {
                const cart = this.state.cart.filter(c => c.id !== product_id);
                this.setState({ cart }, this.updateBalance);
            })
            .catch(error => {
                Swal.fire(
                    'Error',
                    error.response.data.message,
                    'error'
                );
            });
    }

    handleEmptyCart() {
        axios.delete('/admin/cart/empty')
            .then(res => {
                this.setState({ cart: [] }, () => {
                    this.loadCart();
                });
            })
            .catch(error => {
                Swal.fire(
                    'Error',
                    error.response.data.message,
                    'error'
                );
            });
    }

    handleSearchProduct(event) {
        const search = event.target.value;
        this.setState({ search }, () => {
            this.handleSearch(search);
        });
    }

    handleSearch(search) {
        this.loadProducts(search);
    }

    handleAddToCart(barcode) {
        axios.post('/admin/cart/store', { barcode })
            .then(res => {
                this.loadCart();
                this.setState({ barcode: '' });
            })
            .catch(error => {
                Swal.fire(
                    'Error',
                    error.response.data.message,
                    'error'
                );
            });
    }

    setCustomerId(event) {
        const customer_id = event.target.value;
        this.setState({ customer_id });
    }

    handleClickSubmit() {
        const { customer_id, paidAmount, balance } = this.state;

        axios.post('/admin/order/store', { customer_id, amount: paidAmount , balance })
            .then(res => {
                Swal.fire(
                    'Success',
                    'Order placed successfully!',
                    'success'
                );
                this.generatePDF();
                this.loadCart();
            })
            .catch(error => {
                Swal.fire(
                    'Error',
                    error.response.data.message,
                    'error'
                );
            });
    }

    generatePDF() {
        const { cart, paidAmount, balance, customers, customer_id } = this.state;
        const customer = customers.find(c => c.id === parseInt(customer_id));

        const doc = new jsPDF();
        doc.setFontSize(18);
        doc.text('Voucher', 105, 10, null, null, 'center');
        doc.setFontSize(12);
        doc.text(`Customer Name: ${customer ? customer.first_name + ' ' + customer.last_name : 'N/A'}`, 10, 20);
        doc.text(`Date: ${new Date().toLocaleDateString()} \t Time: ${new Date().toLocaleTimeString()} \t`, 10, 30);
        cart.forEach((item, index) => {
            doc.text(`Products Name: ${item.name} - Quantity: ${item.pivot.quantity} - Price: ${(item.price * item.pivot.quantity).toFixed(2)}`, 10, 40 + (index * 10));
        });

        doc.text(`Total: ${this.getTotal(cart)}${window.APP.currency}`, 10, 40 + (cart.length * 10) + 10);
        doc.text(`Paid Amount: ${paidAmount}${window.APP.currency}`, 10, 40 + (cart.length * 10) + 20);
        doc.text(`Balance: ${balance}${window.APP.currency}`, 10, 40 + (cart.length * 10) + 30);

        doc.save('voucher.pdf');
    }

    render() {
        const { cart, barcode, products, customers, paidAmount, balance } = this.state;
        return (
            <div className="container-fluid">
                <div className="row">
                    <div className="col-lg-12">
                        <div className="d-flex flex-wrap align-items-center justify-content-between mb-4"></div>
                    </div>
                    <div className="col-md-5 mb-4">
                        <div className="row">
                            <div className="col mb-2">
                                <form onSubmit={this.handleScanBarcode}>
                                    <input
                                        type="text"
                                        className="form-control"
                                        placeholder="Scan Barcode..."
                                        value={barcode}
                                        onChange={this.handleOnChangeBarcode}
                                    />
                                </form>
                            </div>
                            <div className="col mb-2">
                                <select onChange={this.setCustomerId} className="form-control">
                                    <option value="">Select Customer</option>
                                    {customers.map(c => (
                                        <option key={c.id} value={c.id}>{c.first_name} {c.last_name}</option>
                                    ))}
                                </select>
                            </div>
                            <div className="col-md-12">
                                <div className="table-responsive user-cart">
                                    <table className="table table-striped">
                                        <thead>
                                            <tr className="light">
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th className="text-right">Price</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody className="addMoreProduct">
                                            {cart.map(c => (
                                                <tr key={c.id}>
                                                    <td name="product_name">{c.name}</td>
                                                    <td>
                                                        <input
                                                            type="text"
                                                            name="quantity"
                                                            defaultValue={c.pivot.quantity}
                                                            onChange={event => this.handleOnChangeQuantity(c.id, event.target.value)}
                                                            className="form-control form-control-sm qty count"
                                                        />
                                                    </td>
                                                    <td className="text-right price">{(c.price * c.pivot.quantity).toFixed(2)}{window.APP.currency}</td>
                                                    <td>
                                                        <button className="btn-sm btn-danger delete" onClick={() => this.handleClickDelete(c.id)}>
                                                            <i className="fa fa-times"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div className="col-6">Total:</div>
                            <div className="col-6 text-right total mb-2">{this.getTotal(cart)}{window.APP.currency}</div>
                            <div className="col-10">Paid Amount:</div>
                            <input
                                type="text"
                                className="form-control form-control-sm col-2 text-right paid_amount mb-2"
                                value={paidAmount}
                                onChange={this.handlePaidAmountChange}
                            />
                            <div className="col-10">Balance:</div>
                            <input
                                type="text"
                                className="form-control form-control-sm col-2 text-right balance mb-2"
                                id="balance"
                                value={balance}
                                readOnly
                            />
                            <div className="col-6">
                                <button type="button" className="btn btn-danger btn-block" onClick={this.handleEmptyCart}
                                    disabled={!cart.length}>
                                    Cancel
                                </button>
                            </div>
                            <div className="col-6">
                                <button type="submit" className="btn btn-primary btn-block" disabled={!cart.length} onClick={this.handleClickSubmit}>
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-7 mb-4">
                        <div className="mb-2">
                            <input
                                type="text"
                                className="form-control"
                                placeholder="Search Product..."
                                onChange={this.handleSearchProduct}
                                value={this.state.search}
                            />
                        </div>
                        <div className="order-product">
                            {products.map(p => (
                                <div onClick={() => this.handleAddToCart(p.barcode)} key={p.id} className="item mr-2">
                                    <img src={p.image_url} alt="" />
                                    <h5 style={window.APP.warning_quantity > p.quantity ? { color: 'red' } : null}>{p.name}</h5>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default Cart;

if (document.getElementById('cart')) {
    const root = createRoot(document.getElementById('cart'));
    root.render(<Cart />);
}
