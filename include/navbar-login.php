<?php?>
<header id="navbar" class="mb-3"></header>
<script type="text/babel">

    function Navbar(){

        let [alignAvatar, setAvatar] = React.useState(false);
        let [login, setLogin] = React.useState(0);
        let [userLog, setUserLog] = React.useState([]);
        let [email, setEmail] = React.useState('');
        let [pword, setPword] = React.useState('');
        let [register, setRegister] = React.useState(0);
        let [logout, setLogout] = React.useState(0);
        let [cartCount, setCartCount] = React.useState('');

        React.useEffect((data)=>{
            // console.log('cokiee');
            checkCookie();
        }, [])

        console.log(cartCount)

        React.useEffect(()=>{
            getCartCount();
        })

        const getCartCount = ()=>{
            let count = localStorage.getItem('count');
            setCartCount(count);
        }

        const handleLoginSubmit = (e)=>{
            e.preventDefault()
            let data = {
                email,
                pword
            }
            $.ajax({
                url: '/nonpm/server/server.php',
                method: 'POST',
                data: {data, 'login': 1}
            })
            .done((data)=>{
               if(!data){
                    console.log('false');
               }else if(data === 'invalid'){
                    console.log('invalid username and password');
               }else{
                    setUserLog(JSON.parse(data));
                    setLogin(1);
                    $('#login-modal').modal('hide')       
               }
            })
        }

        const cookieAuth = (id)=>{
            console.log(id)
            $.ajax({
                url: '/nonpm/server/server.php',
                method: 'GET',
                data: {id, isAuth: 1}
            })
            .done((data)=>{
                alert(data);
                setUserLog(JSON.parse(data));
                console.log('cookie')
            })
        }

        const checkCookie = ()=>{
            $.ajax({
                url: '/nonpm/application/storage.php',
                method: 'GET',
                data: 'getUserCookie=1'
            })
            .done((data)=>{
                if(!data){
                    setLogin(0);
                }else{
                    setLogin(1)
                    cookieAuth(data)
                }
            })
        }

        const modalBody = ()=>{
            if(register){
                return(
                    <React.Fragment>
                        <div className="md-form mb-4">
                            <i className="fas fa-envelope prefix"></i>
                            <input type="text" className="form-control" id="email"/>
                            <label htmlFor="email">Email</label>
                        </div>
                        <div className="md-form mb-4">
                            <i className="fas fa-address-card prefix"></i>
                            <input type="text" className="form-control" id="f_name"/>
                            <label for="f_name">First Name</label>
                        </div>
                        <div className="md-form mb-4">
                            <i className="fas fa-address-card prefix"></i>
                            <input type="text" className="form-control" id="l_name"/>
                            <label htmlFor="l_name">Last Name</label>
                        </div>
                        <div className="md-form mb-4">
                            <i className="fas fa-lock prefix"></i>
                            <input type="password" className="form-control" id="pword"/>
                            <label htmlFor="pword">Password</label>
                        </div>
                        <div className="md-form mb-4">
                            <i className="fas fa-lock prefix"></i>
                            <input type="password" className="form-control" id="re-pword"/>
                            <label htmlFor="re-pword">Re-Type Password</label>
                        </div>
                    </React.Fragment>
                )
            }
            return(
                <React.Fragment>
                    <div className="md-form mb-5">
                        <i className="fas fa-envelope prefix deep-purple-text"></i>
                        <input type="email" className="form-control" id="email" onChange={(e)=>setEmail(e.target.value)}/>
                        <label htmlFor="email">Email</label>
                    </div>
                    <div className="md-form mb-5">
                        <i className="fas fa-lock prefix deep-purple-text"></i>
                        <input type="password"id="pword" className="form-control" onChange={(e)=>setPword(e.target.value)}/>
                        <label htmlFor="pword">Password</label>
                    </div>
                </React.Fragment>
            )
        } 

        const loginModal = ()=>{
            return(
                <div className="modal fade" id="login-modal">
                    <div className="modal-dialog">
                        <div className="modal-content">
                            <form onSubmit={(e)=>handleLoginSubmit(e)}>
                                <div className="modal-header text-center">
                                    {register ? 
                                        <button 
                                            type="button" 
                                            className="btn btn-default btn-sm" 
                                            onClick={()=>setRegister(0)}
                                        ><i className="fas fa-long-arrow-alt-left prefix"></i></button>
                                    : null}
                                    <h5 
                                        className="modal-title w-100 font-weight-bold deep-purple-text"
                                        style={register ? {marginTop: '5px', marginRight: '27px'} : null}
                                    >{register ? 'Register' : 'Login'}</h5>
                                    <button 
                                        type="button" 
                                        className="close" 
                                        data-dismiss="modal" 
                                        style={register ? {marginTop: '-8px'} : null}
                                    ><span>&times;</span></button>
                                </div>
                                <div className="modal-body">
                                    {modalBody()}
                                    <div className="md-form d-flex justify-content-center">
                                        <button type="button" className="btn peach-gradient btn-rounded form-control" onClick={(e)=>setRegister(1)}>Register</button>
                                    </div>
                                </div>
                                <div className="modal-footer d-flex justify-content-left">
                                    <button type="submit" className="btn purple-gradient waves-effect btn-sm">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            )
        }

        const logoutUser = (e)=>{
            $.ajax({
                url: '/nonpm/server/server.php',
                method: 'POST',
                data: {id: userLog.id, logoutUser: '1'}
            })
            .done((data)=>{
                setLogout(1);
                location.reload();
                setTimeout(() => {
                    setLogin(0)
                    setLogout(0)
                }, 3000);
            })
        }

        const openModalLogin = ()=>{
            $('#login-modal').modal('toggle')
        }
        
        const loginTemplate = ()=>{
            return login ? 
                <React.Fragment>
                    <ul className="navbar-nav nav-flex-icon md-fd-unset my-auto align-icn-cntr">
                        <li className="nav-item m-auto">
                            <a className="nav-link waves-effect waves-light">1
                            <i className="fas fa-shopping-cart"></i>
                            </a>
                        </li>
                        <li className="nav-item avatar dropdown m-auto">
                            <a className="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-2.jpg" className="rounded-circle z-depth-0 avtr-height"
                                alt="avatar image" />
                            </a>
                            <div className="dropdown-menu dropdown-menu-right dropdown-secondary"
                                aria-labelledby="navbarDropdownMenuLink-55">
                                <a className="dropdown-item">Email: {userLog ? userLog.email : null}</a>
                                <a className="dropdown-item" onClick={(e)=>logoutUser(e)}>Logout</a>
                            </div>
                        </li>
                    </ul>
                </React.Fragment>
                :
                <button className="btn btn-outline-default waves-effect" onClick={(e)=>openModalLogin(e)}>Sign In</button>
        }

        if(logout){
            return(
                <div>Logging Out...</div>
            )
        }

        return(
            <React.Fragment>
                <nav className="navbar navbar-expand-lg navbar-dark secondary-color lighten-1">
                    <a href="#" className="navbar-brand">Navbar</a>
                    <div className="position-absolute md-w-90 w-98 d-flex align-item-end" style={alignAvatar ? {bottom: '157px'} : null}>
                        {loginTemplate(login)}
                    </div>
                    <button 
                        className="navbar-toggler" 
                        type="button" 
                        onClick={()=>alignAvatar ? setAvatar(false) : setAvatar(true)} 
                        data-toggle="collapse" 
                        data-target="#navbarSupportedContent-555"
                        aria-controls="navbarSupportedContent-555" aria-expanded="false" aria-label="Toggle navigation">
                        <span className="navbar-toggler-icon"></span>
                    </button>
                    <div className="collapse navbar-collapse" id="navbarSupportedContent-555">
                        <ul className="navbar-nav mr-auto">
                            <li className="nav-item">
                                <a className="nav-link" href="#">Home
                                <span className="sr-only">(current)</span>
                                </a>
                            </li>
                            <li className="nav-item">
                                <a className="nav-link" href="#">Features</a>
                            </li>
                            <li className="nav-item">
                                <a className="nav-link" href="#">Pricing</a>
                            </li>
                            <li className="nav-item dropdown">
                                <a className="nav-link dropdown-toggle" id="navbarDropdownMenuLink-555" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">Dropdown
                                </a>
                                <div className="dropdown-menu dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-555">
                                    <a className="dropdown-item" href="#">Action</a>
                                    <a className="dropdown-item" href="#">Another action</a>
                                    <a className="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div>
                    <img src="widgetUI/images/img (137).jpg" className="img-fluid" style={{width: '100%'}}/>
                </div>
                {loginModal()}
            </React.Fragment>
        )
    }
    ReactDOM.render(<Navbar />, document.querySelector('#navbar'))
</script>