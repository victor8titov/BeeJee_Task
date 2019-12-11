
function requestToServer(url,data,method = "POST") {
        const promise = new Promise( (resolve, reject)=>{
            const xhr = new XMLHttpRequest();
            xhr.open(method, url, true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');  
            xhr.onreadystatechange = () => {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    //console.log('--:','onreadystatechange',xhr.responseText)
                    console.log('responce server')
                    resolve(xhr.responseText);
                } else {
                    if (xhr.readyState === 4) reject(`Запрос завершён с кодом ответа: ${xhr.status}`)
                } 

            };
            console.log('--:','send: ', data )
            xhr.send('data=' + JSON.stringify(data));
        })
        return promise;
    }


export default requestToServer;

