import * as React from "react";
import {
    List,
    Datagrid,
    TextField,
    EditButton,
    Edit,
    useRecordContext,
    SimpleForm,
    TextInput,
    Create
} from 'react-admin';
import BookIcon from '@mui/icons-material/Book';
import {useEffect, useState} from "react";
import {Input, Button} from "antd";
import TicketService from "../../services/TicketService";

export const TicketIcon = BookIcon;

export const TicketList = () => {
    const [inputValue, setInputValue] = useState('');
    const [ticketDetails, setTicketDetails] = useState(null);

    const onChange = (e) => {
        setInputValue(e.currentTarget.value);
    }

    const handleClick = () => {
        TicketService.getTickets(inputValue)
            .then(r => {
                setTicketDetails(r.data);
            })
            .catch(e => {
                console.log(e);
            });
    }

    return (
        <div>
            <div style={{fontSize: "18px", marginTop: "30px", display: "flex", flexDirection: "column", gap: "20px"}}>
                Insert the session Id sent in the email

                <div style={{display: "flex", flexDirection: "row", gap: "20px"}}>
                    <Input onChange={onChange}/>
                    <Button type="primary" onClick={handleClick}>Get info</Button></div>
            </div>

            {
                ticketDetails ? (
                    <>
                        {ticketDetails.map(ticket => {
                            return (
                                <div className="" key={ticket.id}>
                                    <div>
                                        Movie: {ticket.film_name}
                                        Name: {ticket.user_name}
                                        Seat: {ticket.seat_name}
                                        Time: {ticket.start_time}
                                        Seat type: {ticket.seat_type}
                                    </div>
                                </div>
                            )
                        })}
                    </>
                ) : (<div style={{fontStyle: "italic", fontSize: "14px", marginTop: "5px"}}>Wrong id</div>)
            }

        </div>
    );
};
