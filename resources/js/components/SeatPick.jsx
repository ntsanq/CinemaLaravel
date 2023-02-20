import React, {useEffect} from 'react';
import {useState} from "react";

export default function SeatPick(props) {

    const alpha = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I'];

    const allSeats = props.seatsData.allSeats === undefined ? [] : props.seatsData.allSeats;
    const occupied = props.seatsData.occupied;

    const [selectedSeats, setSelectedSeats] = useState([]);
    const [selectedCategory, setSelectedCategory] = useState(null);

    useEffect(() => {
        if (selectedSeats.slice(-1)[0] !== undefined) {
            props.getSeatInfo(selectedSeats.slice(-1)[0]);
        }
    }, [selectedSeats])

    const seatsCategory = [
        {
            price: 120000,
            seats: allSeats,
            occupied: occupied
        }
    ];

    const handleOnClick = (seat, category) => {
        const isSelected = selectedSeats.indexOf(seat) > -1;
        if (isSelected) {
            const newSelectedSeats = selectedSeats.filter(
                (selectedSeat) => selectedSeat !== seat
            );
            setSelectedSeats(newSelectedSeats);
        } else {
            if (
                selectedSeats.length !== 0 &&
                selectedCategory &&
                selectedCategory.name !== category.name
            ) {
                alert("Must be the same category");
            } else if (selectedSeats.length > 5) {
                alert("Maximum 5 seats allowed");
            } else {
                setSelectedSeats([...selectedSeats, seat]);
                setSelectedCategory(category);
            }
        }
    };

    const handleSelectedOnChange = (selectedSeats) => {
    }

    return (
        <>
            <h1 className='hi'>Seat picker</h1>
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
                <div className="total">
                    <span>Seats Count: {selectedSeats.length}</span>{" "}
                    <span>Price: ${selectedCategory ? selectedSeats.length * selectedCategory.price : 0}</span>
                    <span onChange={handleSelectedOnChange(selectedSeats)}>You selected: {selectedSeats.map(seat => <span key={seat}>{seat}</span>)}</span>
                </div>
            </div>
        </>
    );
}
