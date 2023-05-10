import * as React from "react";
import {useEffect, useState} from "react";
import {Input, Button} from "antd";
import TicketService from "../../services/TicketService";
import ConfirmationNumberIcon from '@mui/icons-material/ConfirmationNumber';
import Barcode from 'react-barcode';


export const TicketIcon = ConfirmationNumberIcon;

export const TicketList = () => {
    const [inputValue, setInputValue] = useState('');
    const [ticketDetails, setTicketDetails] = useState(null);
    const [messagePlace, setMessagePlace] = useState('Input the session id');
    const onChange = (e) => {
        setInputValue(e.currentTarget.value);
    }

    const handleKeyDown = (e) => {
        if (e.key === "Enter") {
            handleClick();
        }
    };

    const handleClick = () => {
        TicketService.getTickets(inputValue)
            .then(r => {
                setTicketDetails(r.data);
            })
            .catch(e => {
                console.log(e.message);
                setMessagePlace('Wrong session id');
                setTicketDetails(null);
            });
    }

    const handlePrint = (sessionId) => {
        TicketService.printed(sessionId).then(r => {
            console.log(r.data)
        }).catch(e => {
            console.log(e)
        });
    }

    return (
        <div className="ticket-check-page">
            <div className="ticket-check--title noPrint">
                Insert the session Id sent in the email

                <div className="ticket-check--input">
                    <Input onChange={onChange} onKeyDown={handleKeyDown}/>
                    <Button type="primary" onClick={handleClick}>Get info</Button></div>
            </div>


            <div className="print-no-display">
                <b>SAN Cinema Ticket</b>
                <br/>
                Date: {new Date().toLocaleString() + ""}
                <br/>
                Staff: Thanh Sang
                <br/>
                Customer: {ticketDetails ? ticketDetails[0].user_name : ""}
                <div>====================</div>
                <br/>
            </div>
            {
                ticketDetails ? (
                    <>
                        {ticketDetails.map(ticket => {
                            return (
                                <>
                                    <div className="ticket-check--details" key={ticket.id}>
                                        <div>
                                            Movie: <b>{ticket.film_name}</b>
                                            <br/>
                                            Name: {ticket.user_name}
                                            <br/>
                                            Seat: <b>{ticket.seat_name}</b>
                                            <br/>
                                            Time: {ticket.start_datetime}
                                            <br/>
                                            Seat type: {ticket.seat_type}
                                        </div>
                                    </div>
                                    <div className="print-no-display">----------------------------</div>
                                </>
                            )
                        })}

                        <div className="ticket-check-print--barcode">
                            <div className="print-no-display">
                                <Barcode value={ticketDetails[0].seat_name + ticketDetails[0].film_name}
                                         fontSize="10px"/>
                            </div>
                        </div>
                        <Button className="ticket-check--print-button noPrint" type="default"
                                onClick={() => {
                                    window.print();
                                    handlePrint(inputValue);
                                }}>Print</Button>
                    </>
                ) : (<div className="ticket-check--message">
                    <span>
                        {messagePlace}
                    </span>
                </div>)
            }

        </div>
    );
};
