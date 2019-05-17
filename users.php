<?php
    include_once 'include/head.php'
?>
<body>
    
    <div id="root"></div>

    <?php include_once 'include/scripts.php'?>
    <script type="text/babel">
    
        function App(){
            let [usersdata, setUsersdata] = React.useState([
                {id: 1, name: 'jason', lastname: 'flores'},
                {id: 3, name: 'Anthony', lastname: 'flores'},
                {id: 4, name: 'Flores', lastname: 'Jason'}
            ])
            console.log('try')
            const samples = ()=>{
                
            }

            const tableData =()=>{
                return(
                    usersdata ? 
                        usersdata.map((item)=>{
                            return(
                                <tr key={item.id}>
                                    <td>{item.name}</td>
                                    <td>{item.lastname}</td>
                                </tr>
                            )
                        })
                    : null
                )
            }
            
            const addUser = ()=>{
                const newUser = {
                    id: 7,
                    name: 'qwe',
                    lastname: 'qweqwe'
                }
                let prevuser = [];
                prevuser.push(...usersdata,newUser);
                console.log(prevuser)
                setUsersdata(prevuser)
            }

           return(
               <div>
                    <table className="table">
                        <thead className="black white-text">
                            <tr>
                                <th>Name</th>
                                <th>Lastname</th>
                            </tr>
                        </thead>
                        <tbody>
                            {tableData()}
                        </tbody>
                    </table>
                    <button onClick={()=>addUser()}>Add</button>
               </div>
           )
       }

       function Sample(){
           const [sample, setSample] = React.useState('hello world')

            const Runn = ()=>{
                setSample("World")
            }

            const SampleFunt =()=>{
                console.log(123)
            }
            return(
                <div onClick={()=>Runn()}>{sample}{SampleFunt()}</div>
            )
       }

        ReactDOM.render(<App/>, document.querySelector('#root'))
    </script>
</body>
</html>