<?php 

    include_once 'include/head.php';
    include_once 'include/navbar-login.php';
    define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/nonpm/')

?>
<body>
    <div id="root" class="container"></div>

    <?php include_once 'include/scripts.php'?>
    <script type="text/babel">
        function Index(){
            let [itemsState, setItems] = React.useState('');
            let [itemDetails, setItemDetails] = React.useState('');
            let [inputQty, setQty] = React.useState();
            let [sample, setSample] = React.useState();
            let [cart, setCart] = React.useState([]);
            let [cokie, setCokie] = React.useState(0);

            React.useEffect(()=>{
                getProduct();
                checkCokie();
            }, [])

            React.useEffect(()=>{
                countCart();
            })

            const countCart =()=>{
                let count = cart.length;
                localStorage.setItem("count", count)
            }

            const getProduct = ()=>{
                let skip = itemsState.length;
                $.ajax({
                    url: `server/server.php?limit=${10}&skip=${skip}`,
                    method: 'GET',
                    data: 'getProduct=1'
                })
                .done((data)=>{
                    let dataItem = JSON.parse(data);
                    if(itemsState){
                        let mergedArray = itemsState.concat(dataItem);
                        setItems(mergedArray);
                    }else{
                        setItems(dataItem);
                        console.log('else');
                    }
                    
                })
            }

            const checkCokie = ()=>{
                $.ajax({
                    url: '/nonpm/application/storage.php',
                    method: 'GET',
                    data: 'getUserCookie=1'
                })
                .done((data)=>{
                    setCokie(data);
                })
            }

            React.useEffect(()=>{
                getCart();
            }, [cokie])

            const getCart = ()=>{
               $.ajax({
                   url: '/nonpm/server/server.php',
                   method: 'GET',
                   data: {id: cokie, 'getCart': 1}
               })
               .done((data)=>{
                   !data ? setCart([]) : setCart(JSON.parse(data));
               })
            }


            const handleInputqty = (e)=>{
                setQty(e.target.value)
            }

            const modalBodyTemplate = (props)=>{
                let qty = (typeof inputQty === 'undefined') ? '' : inputQty
                let stocks = parseInt(props.stocks) - qty
                return props ? 
                    <div className="row">
                        <div className="col-lg-7">
                            <img src={`images/${props.img}`} className="img-fluid"/>
                        </div>
                        <div className="col-lg-5">
                            <div className="card mb-5">
                                <div className="card-body">
                                    <h5 className="card-title">Description</h5>
                                    <p className="card-text">
                                        {props.descr}
                                    </p>
                                </div>
                            </div>        
                            <div className="md-form form-md">
                                <input type="number" min="0" id="qty" className="form-control" onChange={(e)=>handleInputqty(e)} value={inputQty}/>
                                <label htmlFor="qty">Quantity</label>
                            </div>
                            <div className="md-form from-md">
                                <p>Storage: {stocks}</p>
                            </div>
                        </div>
                    </div>
                : null
            }

            const addToCart = (props)=>{
                let item = {
                    id: props.id,
                    owner_id: props.owner_id,
                    product_name: props.product_name,
                    qty: inputQty,
                    price: props.price,
                    img: props.img,
                    descr: props.descr
                }
                cart.map((cartItem, x)=>{
                    if(cartItem.id === item.id){
                        item.qty = parseInt(item.qty) + parseInt(cartItem.qty)
                        cart.splice(x, 1)
                    }
                })
                cart.push(item)
                $.ajax({
                    url: '/nonpm/server/server.php',
                    method: 'POST',
                    data: {id: cokie,item: cart, 'addtocart': 1}
                })
                .done((data)=>{
                    console.log(cart);
                })
            }

            const modalTemplate = (props)=>{
                console.log(props)
                return(
                    <div className="modal fade" id="Modal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div className="modal-dialog modal-lg" role="document">
                            <div className="modal-content">
                                <div className="modal-header">
                                    <h5 className="modal-title title-items" id="ModalLabel"><span className="txt-clr-bluegrey font-weight-bold">{props.product_name}</span></h5>
                                    <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div className="modal-body">
                                    {modalBodyTemplate(props)}
                                </div>
                                <div className="modal-footer">
                                    <button type="button" className="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" className="btn btn-primary" onClick={()=>addToCart(props)}><i className="fas fa-cart-plus"></i> Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                )
            }


            const openModal = (props)=>{
                setItemDetails(props)
                $('#Modal').modal('toggle')
            }

            const itemsTemplate = (props)=>{
                return(
                    <React.Fragment>
                        <div className="view overlay w-100">
                            <img src={`images/${props.img}`} style={{borderRadius: '5px'}} className="img-fluid" alt="img"/>
                            <a onClick={()=>openModal(props)}>
                                <div className="mask waves-effect waves-light rgba-white-slight"></div>
                            </a>
                        </div>
                        <p className="note note-secondary">
                            <strong>Name:</strong> <span>{props.product_name}</span><br />
                            <strong>Price</strong> <span>{props.price}</span>
                        </p>
                    </React.Fragment>
                )
            }

            const loadItems = ()=>{
                return itemsState ?
                    itemsState.map((item)=>{
                        return(
                            <div className="col-6 col-md-4 col-lg-3 mb-3" key={item.id}>
                                {itemsTemplate(item)}
                            </div>
                        )
                    })
                : <div>Empty</div>
            }

            return(
                <React.Fragment>
                    <h3 className="text-center mb-5 font-weight-light">Feature Product</h3>
                    <div className="row">
                        {loadItems()}
                    </div>
                    {modalTemplate(itemDetails)}
                    <button type="button" onClick={()=>getProduct()} className="btn peach-gradient waves-effect">LoadMore</button>
                </React.Fragment>
            )
        }
        ReactDOM.render(<Index />, document.querySelector('#root'))
    </script>
</body>
</html>