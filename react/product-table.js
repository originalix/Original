class ProductCategoryRow extends React.Component {
    render() {
        return (
            <tr><th colSpan="2">{this.props.category}</th></tr>
        );
    }
}

class ProductRow extends React.Component {
    render() {
        const name = this.props.product.stocked ?
            this.props.product.name :
            <span style={{color: 'red'}}>
                this.props.product.name
            </span>
        return (
            <tr>
                <td>{name}</td>
                <td>{this.props.product.price}</td>
            </tr>
        );
    }
}

ReactDOM.render(
    <ProductCategoryRow category="nba" />,
    document.getElementById('root')
);