<?php
    include_once 'include/head.php';
    $directory = dirname(__DIR__);
    define("BASEURL", $_SERVER['DOCUMENT_ROOT']."/nonpm/")
?>
    
    <body> 
        <div id="root" class="container">
        </div>

        <?php include_once 'include/scripts.php'; ?>
        <script type="text/babel">
            function ProductList(){

                let [imagesrc, setImagesrc] = React.useState('');
                let [listItem, setListItem] = React.useState([]);
                let [productName, setProductName] = React.useState('');
                let [priceval, setPriceVal] = React.useState('');
                let [stocksval, setStocksVal] = React.useState('');
                let [auth, setAuth] = React.useState('');
                let [desc, setDesc] = React.useState('');

                // console.log(listItem)

                
                React.useEffect(()=>{
                    getCookie();
                }, [])

                React.useEffect(()=>{
                    getProductItem();
                }, [auth])

                const getCookie = ()=>{
                    $.ajax({
                        url: '/nonpm/admin/application/storage.php',
                        method: 'GET',
                        data: 'getCookie=1'
                    })
                    .done((data)=>{                        
                        if(data){
                            setAuth(data)
                            // console.log('dataAuth')
                        }
                        if(!data){
                            window.location.href= '/nonpm/admin/login.php';
                        }
                    })
                }

                const getProductItem = ()=>{
                    // console.log(auth)
                    $.ajax({
                        url: '/nonpm/server/server.php',
                        method: 'GET',
                        data: {auth, 'getPrductPerUser': 1}
                    })
                    .done((data)=>{
                        // alert(data)
                        if(data){
                            setListItem(JSON.parse(data))
                        }
                    })
                }

                const productItems = (item, x)=>{
                    return(
                        <React.Fragment>
                            <td>{x}</td>
                            <td>{item.product_name}</td>
                            <td className="text-truncate description-td">{item.descr}</td>
                            <td>{item.price}</td>
                            <td>{item.stocks}</td>
                        </React.Fragment>
                    )
                }

                const prodductList = ()=>{
                    let x = 0;
                    return listItem ? 
                        listItem.map((item)=>{
                            x += 1
                            return(
                                <tr key={x}>
                                    {productItems(item, x)}
                                </tr>
                            )
                        })
                        : null
                }

                const fileHandler = (e)=>{
                    let formdata = new FormData();
                    formdata.append('file', e.target.files[0])
                    $.ajax({
                        url: '../server/file.php',
                        datatype: 'text',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: formdata,
                        type: 'post'
                    })
                    .done((done)=>{
                        setImagesrc(done)
                    })
                    
                }

                const formSubmitHandler = (e)=>{
                    e.preventDefault()
                    let data = {
                        'product_name': productName,
                        'price': priceval,
                        'stocks': stocksval,
                        'desc': desc,
                        'image': imagesrc,
                        'auth': auth
                    }
                    $.ajax({
                        url: '/nonpm/server/server.php',
                        method: 'POST',
                        data: {data, 'add_prod': 1}
                    })
                    .done((res)=>{
                        let newData = {
                            'product_name': productName,
                            'price': priceval,
                            'stocks': stocksval,
                            'descr': desc,
                        }
                        let mergeData = [];
                        mergeData = [...listItem, newData]
                        setListItem(mergeData);
                        $('#modal-product').modal('hide');
                    })
                }

                const handleTextArea = (e)=>{
                    setDesc(e.target.value)
                }

                const modalAddProduct = ()=>{
                    return(
                        <div className="modal fade" id="modal-product" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
                            <div className="modal-dialog modal-lg" role="document">
                                <div className="modal-content">
                                    <form onSubmit={(e)=>formSubmitHandler(e)}>
                                        <div className="modal-header">
                                            <h5 className="modal-title" id="modallabel"></h5>
                                            <button type="button" className="close" data-dismiss="modal" aria-label="close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div className="modal-body">
                                            <div className="row">
                                                <div className="col-lg-4">
                                                    <div className="md-form">
                                                        <input type="text" id="product_name" className="form-control" onChange={(e)=>setProductName(e.target.value)}/>
                                                        <label htmlFor="product_name">Product Name</label>
                                                    </div>
                                                </div>
                                                <div className="col-lg-4">
                                                    <div className="md-form">
                                                        <input type="text" id="price" className="form-control" onChange={(e)=>setPriceVal(e.target.value)}/>
                                                        <label htmlFor="price">Price</label>
                                                    </div>
                                                </div>
                                                <div className="col-lg-4">
                                                    <div className="md-form">
                                                        <input type="text" id="stocks" className="form-control" onChange={(e)=>setStocksVal(e.target.value)}/>
                                                        <label htmlFor="stocks">Stocks</label>
                                                    </div>
                                                </div>
                                                <div className="col-lg-6">
                                                    <div className="md-form">
                                                        <div className="view overlay image-size">
                                                            <img src={`../images/${imagesrc}`} className="img-fluid z-depth-1"/>
                                                            <div className="mask flex-center waves-effect waves-light"></div>
                                                        </div>
                                                    </div>
                                                    <div className="md-form">
                                                        <button className="btn btn-primary aqua-gradient">
                                                            <input type="file" onChange={(e)=>fileHandler(e)} />
                                                        </button>
                                                    </div>
                                                </div>
                                                <div className="col-lg-6">
                                                    <div className="md-form">
                                                        <textarea id="descr" rows="4" className="md-textarea form-control" onChange={(e)=>handleTextArea(e)}></textarea>
                                                        <label htmlFor="descr">Description</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div className="modal-footer">
                                            <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" className="btn btn-primary waves-effect">Add Product</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    )
                }

                const openModal = ()=>{
                    $('#modal-product').modal('toggle')
                }


                return(
                    <React.Fragment>
                        <h3 className="text-responsive green-text font-weight-bold my-4">Product List</h3>
                        <div className="btn btn-sm aqua-gradient waves-effect mb-3" onClick={()=>openModal()}>Add Product</div>
                        <table className="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Stocks</th>
                                </tr>
                            </thead>
                            <tbody>
                                {prodductList()}
                            </tbody>
                        </table>
                        {modalAddProduct()}
                    </React.Fragment>
                )
            }

            ReactDOM.render(<ProductList />, document.querySelector('#root'))
        </script>
    </body>

</html>