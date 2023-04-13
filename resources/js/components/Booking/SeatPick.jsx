import React, {useEffect} from 'react';
import {useState} from "react";
import Loading from "./Loading";

export default function SeatPick(props) {

    const alpha = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J'];

    const allSeats = props.seatsData.allSeats === undefined ? [] : props.seatsData.allSeats;
    const occupied = props.seatsData.occupied;

    const [selectedSeats, setSelectedSeats] = useState([]);

    const [loading, setLoading] = useState(false)

    useEffect(() => {
        setSelectedSeats([]);
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
        <div className="seat-pick uk-margin-large-bottom">
            <h2 className="uk-text-contrast">Choose seats:</h2>
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
                                                                        <div key={`seat-${seat + j}`}
                                                                             className={`uk-text-center seat ${isSelected ? "selected" : ""} ${
                                                                                 isOccupied ? "occupied" : ""
                                                                             }`}
                                                                             onClick={() => {
                                                                                 if (!isOccupied) {
                                                                                     handleOnClick(seat, category);
                                                                                 } else {
                                                                                     null;
                                                                                 }
                                                                             }}>
                                                                            {j + 1}{alpha[i]}
                                                                        </div>
                                                                    </React.Fragment>
                                                                );
                                                            })}
                                                        </div>
                                                    ))}
                                                </div>
                                            );
                                        })}
                                    </div>

                                    <div className="uk-margin-large-top">
                                        <h3 style={{fontStyle: "italic"}}>Annotate:</h3>
                                        <div>
                                            <hr width="103%"/>
                                        </div>
                                        <div className="" style={{ fontStyle: "italic"}}>
                                            <div className="uk-flex uk-flex-row">
                                                <div className="seat" style={{background: "#ffc329"}}></div>
                                                Premium seat
                                                <div className="seat"></div>
                                                Available seat
                                                <div className="seat selected" style={{marginLeft: 'auto'}}></div>
                                                Selected seat
                                                <div className="seat occupied"></div>
                                                Occupied seat
                                            </div>
                                        </div>
                                    </div>

                                </> : <div>Pick a date and a time first</div>
                        }
                    </>
            }
        </div>
    );
}
