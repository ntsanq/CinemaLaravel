import React, {useEffect} from 'react';
import {useState} from "react";
import Loading from "./Loading";

export default function SeatPick(props) {

    const alpha = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];

    const allSeats = props.seatsData.allSeats === undefined ? [] : props.seatsData.allSeats;
    const occupied = props.seatsData.occupied;

    const [selectedSeats, setSelectedSeats] = useState([]);

    const [loading, setLoading] = useState(false)

    useEffect(() => {
        setLoading(true)
        setTimeout(() => {
            setLoading(false)
        }, 500)
    }, [props.seatsData.allSeats])


    const seatsCategory = [
        {
            seats: allSeats,
            occupied: occupied
        }
    ];

    const handleOnClick = (seat) => {
        props.onData(seat);
        const isSelected = selectedSeats.indexOf(seat) > -1;
        if (isSelected) {
            const newSelectedSeats = selectedSeats.filter(
                (selectedSeat) => selectedSeat !== seat
            );
            setSelectedSeats(newSelectedSeats);
        } else {
            setSelectedSeats([...selectedSeats, seat]);
        }
    };

    return (
        <>

            <h1>Choose your seat</h1>
            {
                loading ? <Loading/> :
                    <>
                        {
                            (allSeats[0]) ?
                                <>
                                    <div className="screen"></div>
                                    <div className="all-seats">
                                        {seatsCategory.map((category, k) => {
                                            const noOfRows = Math.ceil(category.seats.length / 8);
                                            const newSeatList = [];
                                            for (let i = 0; i < noOfRows; i++) {
                                                newSeatList[i] = category.seats.slice(i * 8, i * 8 + 8);
                                            }
                                            return (
                                                <div className="seats-section" key={k}>
                                                    <h4>{category.name}</h4>
                                                    {newSeatList.map((seats, i) => (
                                                        <div key={`${k}-${i}`} className="seats">
                                                            {seats.map((seat, j) => {
                                                                const isSelected = selectedSeats.indexOf(seat) > -1;
                                                                const isOccupied = category.occupied.indexOf(seat) > -1;
                                                                return (
                                                                    <React.Fragment key={`seat-${seat + j}`}>
                                                                        <span> {j + 1}{alpha[i]}</span>
                                                                        <div
                                                                            key={`seat-${seat + j}`}
                                                                            className={`seat ${isSelected ? "selected" : ""} ${
                                                                                isOccupied ? "occupied" : ""
                                                                            }`}
                                                                            onClick={() => {
                                                                                if (!isOccupied) {
                                                                                    handleOnClick(seat, category);
                                                                                } else {
                                                                                    null;
                                                                                }
                                                                            }}
                                                                        />
                                                                    </React.Fragment>
                                                                );
                                                            })}
                                                        </div>
                                                    ))}
                                                </div>
                                            );
                                        })}
                                    </div>
                                </> : <div>Pick a date and a time first</div>
                        }

                    </>
            }
        </>
    );
}
