import React, { Component } from 'react';
import { createRoot } from 'react-dom/client';
import axios from 'axios';

import './Cart';

class Cart extends Component {
    constructor(props) {
        super(props);
        this.state = {
            cart: [],
            barcode: '',
        };
        this.loadCart = this.loadCart.bind(this);
        this.handleOnChangeBarcode = this.handleOnChangeBarcode.bind(this);
        this.handleScanBarcode = this.handleScanBarcode.bind(this);
    }

    componentDidMount() {
        this.loadCart();
    }

    handleOnChangeBarcode(event) {
        const barcode = event.target.value;
        this.setState({ barcode });
    }

    loadCart() {
        axios.get("/admin/cart").then((res) => {
            const cart = res.data;
            this.setState({ cart });
        });
    }

    handleScanBarcode(event) {
        event.preventDefault();
        const { barcode } = this.state;
        if (barcode) {
            axios.post('/admin/cart/store', { barcode }).then(res => {
                this.loadCart();
                this.setState({ barcode: '' });
            }).catch(error => {
                console.error("There was an error adding the product to the cart!", error);
            });
        }
    }

    render() {
        const { cart, barcode } = this.state;
        return (
            <div className="container-fluid">
                <div className="row">
                    <div className="col-lg-12">
                        <div className="d-flex flex-wrap align-items-center justify-content-between mb-4"></div>
                    </div>
                    <div className="col-md-5">
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
                                <select name="customer_id" id="customer_id" className="form-control">
                                    <option></option>
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
                                            </tr>
                                        </thead>
                                        <tbody className="addMoreProduct">
                                            {cart.map(c => (
                                                <tr key={c.id}>
                                                    <td name="product_name">{c.name}</td>
                                                    <td>
                                                        <input
                                                            type="number"
                                                            name=""
                                                            defaultValue={c.pivot.quantity}
                                                            className="form-control form-control-sm qty count"
                                                        />
                                                    </td>
                                                    <td className="text-right price">{c.price * c.pivot.quantity}</td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div className="col-6">Total:</div>
                            <div className="col-6 text-right total mb-2"></div>
                            <div className="col-10">Paid Amount:</div>
                            <input
                                type="text"
                                className="form-control form-control-sm col-2 text-right paid_amount mb-2"
                                id="paid_amount"
                            />
                            <div className="col-10">Balance:</div>
                            <input
                                type="text"
                                className="form-control form-control-sm col-2 text-right balance mb-2"
                                id="balance"
                                readOnly
                            />
                            <div className="col-6">
                                <button type="button" className="btn btn-danger btn-block">
                                    Cancel
                                </button>
                            </div>
                            <div className="col-6">
                                <button type="submit" className="btn btn-primary btn-block">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    <div className="col-md-7">
                        <div className="mb-2">
                            <input type="text" className="form-control" placeholder="Search Product..." />
                        </div>
                        <div className="order-product">
                            <div className="item mr-2">
                                <img src="" alt="" />
                                <a href="#">
                                    <h5>Apple</h5>
                                </a>
                            </div>
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
