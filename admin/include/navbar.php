<?php?>
<header id="navbar" class="mb-3"></header>
<script type="text/babel">

    function Navbar(){

        let [alignAvatar, setAvatar] = React.useState(false)
        console.log(alignAvatar)
        
        return(
            <React.Fragment>
                <nav className="navbar navbar-expand-lg navbar-dark secondary-color lighten-1">
                    <a href="#" className="navbar-brand">Navbar</a>
                    <div className="position-absolute md-w-90 w-98 d-flex" style={alignAvatar ? {bottom: '157px'} : null}>
                        <ul className="navbar-nav ml-auto nav-flex-icon md-fd-unset my-auto align-icn-cntr">
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
                                    <a className="dropdown-item" href="#">Action</a>
                                    <a className="dropdown-item" href="#">Another action</a>
                                    <a className="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                        </ul>
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
                    <img src="https://mdbootstrap.com/img/Photos/Slides/img%20(137).jpg" className="img-fluid"/>
                </div>
            </React.Fragment>
        )
    }
    ReactDOM.render(<Navbar />, document.querySelector('#navbar'))
</script>