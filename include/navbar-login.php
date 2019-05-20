<?php?>
<header id="navbar" class="mb-3"></header>
<script type="text/babel">

    function Navbar(){

        let [alignAvatar, setAvatar] = React.useState(false)
        let [login, setLogin] = React.useState(0);
        let [userLog, setUserLog] = React.useState([]);
        let [email, setEmail] = React.useState('');
        let [pword, setPword] = React.useState('');

        React.useEffect((data)=>{
            checkCookie();
        }, [])

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
                setUserLog(JSON.parse(data));
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
        
        console.log(userLog);

        const loginModal = ()=>{
            return(
                <div className="modal fade" id="login-modal">
                    <div className="modal-dialog">
                        <div className="modal-content">
                            <form onSubmit={(e)=>handleLoginSubmit(e)}>
                                <div className="modal-header text-center">
                                    <h5 className="modal-title w-100 font-weight-bold deep-purple-text">Login</h5>
                                    <button type="button" className="close" data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div className="modal-body">
                                    <div className="md-form mb-5">
                                        <i className="fas fa-envelope prefix deep-purple-text"></i>
                                        <input type="email" className="form-control" id="email" onChange={(e)=>setEmail(e.target.value)}/>
                                        <label htmlFor="email">Email</label>
                                    </div>
                                    <div className="md-form mb-5">
                                        <i className="fas fa-lock prefix deep-purple-text"></i>
                                        <input type="text"id="pword" className="form-control" onChange={(e)=>setPword(e.target.value)}/>
                                        <label htmlFor="pword">Password</label>
                                    </div>
                                    <div className="md-form d-flex justify-content-center">
                                        <button type="button" className="btn peach-gradient btn-rounded form-control">Register</button>
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

        const openModalLogin = ()=>{
            $('#login-modal').modal('toggle')
        }
        
        const loginTemplate = ()=>{
            return login ? 
                <React.Fragment>
                    <ul className="navbar-nav nav-flex-icon md-fd-unset my-auto align-icn-cntr">
                        <li className="nav-item m-auto">
                            <a className="nav-link waves-effect waves-light">1
                            <i className="fas fa-envelope"></i>
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
                                <a className="dropdown-item" href="#">Email: {userLog ? userLog.email : null}</a>
                            </div>
                        </li>
                    </ul>
                </React.Fragment>
                :
                <button className="btn btn-outline-default waves-effect" onClick={(e)=>openModalLogin(e)}>Sign In</button>
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