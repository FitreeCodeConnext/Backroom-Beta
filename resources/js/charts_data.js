const axios = require('axios');

async function fetchData() {
    try {
        const response = await axios.post('http://10.10.1.7:9501/backroom/v1/dashboard', {
            branch_id: '000972',
            user_id: 'code'
        });

        const responseData = response.data;
        const tender = responseData['vw_tender_daily'];

        let data = {
            payment_desc: "",
            total: ""
        };

        tender.forEach(item => {
            if (item.payment_desc) {
                data.payment_desc += `'${item.payment_desc}',`;
                data.total += `${item.total},`;
            }
        });

        let groupedData = {};

        responseData['vw_terminal_daily'].forEach(item => {
            const branch_id = item['branch_id'];
            const txntime = item['txntime'];

            if (!groupedData[branch_id]) {
                groupedData[branch_id] = {};
            }

            if (!groupedData[branch_id][txntime]) {
                groupedData[branch_id][txntime] = [];
            }

            groupedData[branch_id][txntime].push(item);
        });

        let groupedData_format = {};

        Object.keys(groupedData).forEach(primary_branch => {
            groupedData_format[primary_branch] = {};
            Object.keys(groupedData[primary_branch]).forEach(txntime => {
                groupedData[primary_branch].forEach(transaction => {
                    if (!groupedData_format[primary_branch].branch_name) {
                        groupedData_format[primary_branch].branch_name = transaction.branch_name || "";
                        groupedData_format[primary_branch].teminal_total = transaction.total.toString();
                    } else {
                        groupedData_format[primary_branch].teminal_total += `,${transaction.total}`;
                    }
                });
            });
        });

        console.log(groupedData_format);

    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

fetchData();
