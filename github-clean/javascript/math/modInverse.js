function modInverse(a, m) {
  // find the gcd
    const s = []
    let b = BigInt(m)
    while(b) {
        [a, b] = [b, a % b]
        s.push({a, b})
    }

    if (a !== BigInt(1)) {
        return NaN // inverse does not exists
    }

    // find the inverse
    let x = BigInt(1)
    let y = BigInt(0)
    for(let i = BigInt(s.length - 2); i >= BigInt(0); --i) {
        [x, y] = [y,  x - y * (s[i].a / s[i].b)]
    }

    return (y % m + m) % m
}
