<?php 

    include_once 'include/head.php';
    include_once 'include/navbar.php';
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

            const getProduct = ()=>{
                let skip = itemsState.length;
                $.ajax({
                    url: `server/server.php?limit=${4}&skip=${skip}`,
                    method: 'GET',
                    data: 'getProduct=1'
                })
                .done((data)=>{
                    let dataItem = JSON.parse(data);
                    if(itemsState){
                        let mergedArray = itemsState.concat(dataItem)
                        setItems(mergedArray)
                    }else{
                        setItems(dataItem)
                    }
                    
                })
            }

            // const isLogin = ()=>{
            //     if(login){

            //     }
            // }

            React.useEffect(()=>{
                getProduct();
            }, [])

            const handleInputqty = (e)=>{
                setQty(e.target.value)
            }

            const modalTemplate = (props)=>{
                let qty = (typeof inputQty === 'undefined') ? setQty(parseInt(0)) : inputQty
                let stocks = parseInt(props.stocks) - qty
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
                                                <input type="number" min="0" id="qty" className="form-control" onChange={(e)=>handleInputqty(e)}/>
                                                <label htmlFor="qty">Quantity</label>
                                            </div>
                                            <div className="md-form from-md">
                                                <p>Storage: {stocks}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="modal-footer">
                                    <button type="button" className="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="button" className="btn btn-primary"><i className="fas fa-cart-plus"></i> Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                )
            }


            const openModal = (props)=>{
                console.log(props)
                setItemDetails(props)
                $('#Modal').modal('toggle')
            }

            const itemsTemplate = (props)=>{
                return(
                    <React.Fragment>
                        <div className="view overlay">
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
            console.log(itemsState)
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