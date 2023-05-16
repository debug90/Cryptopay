import React, { useState, useEffect } from 'react';

function Status() {
  const [data, setData] = useState(null);

  useEffect(() => {
    fetch("http://localhost/CryptoPay/checkout.php")
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json();
      })
      .then((ans) => {
        console.log(ans);
        setData(ans);
      })
      .catch((error) => console.error(error));
      console.log("hii working");
  }, []);

  return (
    <div>
      {data ? (
        <div>
          <p>Name: {data.name}</p>
          <p>Email: {data.email}</p>
          <p>Age: {data.age}</p>
        </div>
      ) : (
        <p>Loading...</p>
      )}
    </div>
  );
}

export default Status;