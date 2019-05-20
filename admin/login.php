<?php 
    include_once 'include/head.php'; 
    // print_r($_COOKIE['username']);
    // setcookie('username', $_COOKIE['username'], time() - 3600, '/')
?>
<body>

    <div id="root" class="container"></div>

    <?php include_once 'include/scripts.php'; ?>
    <script type="text/babel">

        function Login(){
            let [email, setEmail] = React.useState('');
            let [pword, setPword] = React.useState('');

            const handleemail = (e)=>{
                setEmail(e.target.value)
            }

            const handlePword = (e)=>{
                setPword(e.target.value)
            }
        
            const getCookie = ()=>{
                $.ajax({
                    url: 'application/storage.php',
                    method: 'GET',
                    data: 'getCookie=1'
                })
                .done((data)=>{
                    if(data){
                        window.location.href = 'product_list.php'
                    }
                })
            }

            React.useEffect(()=>{
                getCookie();
            }, [])

            const handleFormSubmit = (e)=>{
                e.preventDefault();
                $.ajax({
                    url: '../server/server.php',
                    method: 'POST',
                    data: {
                        AdminLogin: 1,
                        email: email,
                        pword: pword
                    }
                })
                .done((data)=>{
                    // alert(data);
                    if(data === '0'){
                        return console.log('empty')
                    }else if(data === 'invalid'){
                        return console.log('invalid')
                    }
                    window.location.href = 'product_list.php';
                })
                // login();
            }

            return(
                <React.Fragment>
                    <form className="my-form" onSubmit={(e)=>handleFormSubmit(e)}>
                        <div className="card card-body login-size">
                            <h5 className="card-header text-center mb-5">Login</h5>

                            <div className="md-form">
                                <i className="fas fa-envelope prefix"></i>
                                <input type="email" id="email" className="form-control" onChange={(e)=>handleemail(e)}/>
                                <label htmlFor="email">E-mail address</label>
                            </div>
                            <div className="md-form">
                                <i className="fas fa-lock prefix"></i>
                                <input type="password" id="pword" className="form-control" onChange={(e)=>handlePword(e)}/>
                                <label htmlFor="pword">Password</label>
                            </div>

                            <div className="md-form">                           
                                <button type="submit" className="btn btn-primary form-control waves-effect my-btn">Login</button>
                            </div>
                        </div>
                    </form>
                </React.Fragment>
            )
        }

        ReactDOM.render(<Login />, document.querySelector('#root'))

    </script>
</body>
</html>