const { default: axios } = require("axios")

void new class UserEmailNotification
{
    constructor(){
        this.getEmails()
    }

    getEmails = async()=>{
        try{
            const {data:emails} = await axios.get('/email/list')

            emails.forEach(({id,created_at,inquiry_title}) => {

                $('#email-list').append(`
                <div class="d-flex align-items-center mb-6">
                      <div class="symbol symbol-40 symbol-light-success mr-5">
                         <span class="symbol-label">
                            <span class="svg-icon svg-icon-lg svg-icon-success">
                               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.98630124,11 4.48466491,11.0516454 4,11.1500272 L4,7 C4,5.8954305 4.8954305,5 6,5 L20,5 C21.1045695,5 22,5.8954305 22,7 L22,16 C22,17.1045695 21.1045695,18 20,18 L12.9835977,18 Z M19.1444251,6.83964668 L13,10.1481833 L6.85557487,6.83964668 C6.4908718,6.6432681 6.03602525,6.77972206 5.83964668,7.14442513 C5.6432681,7.5091282 5.77972206,7.96397475 6.14442513,8.16035332 L12.6444251,11.6603533 C12.8664074,11.7798822 13.1335926,11.7798822 13.3555749,11.6603533 L19.8555749,8.16035332 C20.2202779,7.96397475 20.3567319,7.5091282 20.1603533,7.14442513 C19.9639747,6.77972206 19.5091282,6.6432681 19.1444251,6.83964668 Z" fill="#000000"/>
                                    <path d="M6.5,14 C7.05228475,14 7.5,14.4477153 7.5,15 L7.5,17 C7.5,17.5522847 7.05228475,18 6.5,18 C5.94771525,18 5.5,17.5522847 5.5,17 L5.5,15 C5.5,14.4477153 5.94771525,14 6.5,14 Z M6.5,21 C5.94771525,21 5.5,20.5522847 5.5,20 C5.5,19.4477153 5.94771525,19 6.5,19 C7.05228475,19 7.5,19.4477153 7.5,20 C7.5,20.5522847 7.05228475,21 6.5,21 Z" fill="#000000" opacity="0.3"/>
                                </g>
                               </svg>
                            </span>
                         </span>
                      </div>
                      <div class="d-flex flex-column font-weight-bold">
                         <a href="/email/details/${id}" class="text-hover-primary mb-1 font-size-lg">${inquiry_title}</a>
                         <span class="text-muted">${humanDate(created_at)} </span>
                      </div>
                   </div>
                `)
            })
            this.getTodaysNotifCount(emails)

        }catch(err){

        }
    }


    getTodaysNotifCount = (email) =>{
        let count = 0
        const dateToday = new Date().toLocaleDateString('en-ca')
        email.forEach(elem => {count++})
        $('#countEmail').text(count)
    }
}
