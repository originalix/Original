function getData() {
  return new Promise((resolve, reject) => {
    setTimeout(() => {
      return resolve({response: 'this is network response'});
      // return reject('error !!!!!');
    }, 2000);
  });
}

async function mockNetwork() {
  const data = await getData();
  // console.log('new work data --->: ', data);
  // data.then((res) => {
  //   console.log('use get data now');
  // });
  // console.log('get data end');
  return data;
}

mockNetwork().then((response) => {
  console.log('mock network get data ---->: ', response);
});
