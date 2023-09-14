function isBalanced(brackets) {
    const matches = {
        "(": ")",
        "{": "}",
        "[": "]",
    };

    const sequence = [];

    for (const bracket of brackets) {
        // push open in stack
        if (matches.hasOwnProperty(bracket)) {
            sequence.push(bracket);
        } else {
            // if closing check if top of sequence matches
            if (sequence.length === 0 || matches[sequence.pop()] !== bracket) {
                return false;
            }
        }
    }

    return sequence.length === 0;
}

isBalanced('([])[]({})') // true
isBalanced('([)]') // false
isBalanced('((()') // false
